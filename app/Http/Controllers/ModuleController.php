<?php

namespace App\Http\Controllers;

use App\Models\AcctMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    public function index(Request $request)
    {
        $tables = DB::table('ACCT_MENU')
            ->selectRaw('*')
            ->orderBy('ACCT_CODE')
            ->get();

        $dual = DB::table('DUAL')->selectRaw("'ALL' OFFICE_CODE, 'ALL OUTLET' NAME_SHORT");

        $outlet = DB::table('FS_MST_OFFICES A')
            ->selectRaw('A.OFFICE_CODE, A.NAME_SHORT')
            ->union($dual)
            ->get();

        return view('dashboard', compact('outlet', 'tables'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'acct_code' => 'required|digits:7|unique:fs_mst_account',
            'acct_name' => 'required',
            'acct_type_jurnal' => 'required',
            'acct_summ' => 'required',
            'acct_status' => 'required',
        ]);

        $data = [
            'acct_seqn' => $request->acct_code,
            'acct_code' => $request->acct_code,
            'acct_parent' => $request->acct_parent,
            'acct_office_code' => $request->acct_office_code,
            'acct_name' => $request->acct_name,
            'acct_type_jurnal' => $request->acct_type_jurnal,
            'acct_summ' => $request->acct_summ,
            'acct_status' => $request->acct_status,
            'acct_flag' => $request->acct_flag,
            'acct_rpt_flag' => $request->acct_rpt_flag,
        ];

        DB::table('FS_MST_ACCOUNT')->insert($data);

        return redirect()->route('dashboard');
    }

    public function update(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'keterangan' => 'required',
            'tipe' => 'required',
            'summary' => 'required',
            'enabled' => 'required',
        ]);

        AcctMenu::where('acct_code', '=', $request->kode)->update([
            'acct_parent' => $request->parent,
            'acct_office_code' => $request->outlet,
            'acct_name' => $request->keterangan,
            'acct_type_jurnal' => $request->tipe,
            'acct_summ' => $request->summary,
            'acct_status' => $request->enabled,
            'acct_flag' => $request->flag_akun,
            'acct_rpt_flag' => $request->flag_report,
        ]);

        return redirect()->route('dashboard');
    }

    public function getMenu(Request $request)
    {
        $parent = DB::table('FS_MST_ACCOUNT A')
            ->selectRaw('A.ACCT_CODE, A.ACCT_NAME')
            ->where('A.ACCT_SUMM', '=', $request->summary)
            ->where('A.ACCT_STATUS', '=', $request->enabled)
            ->where('A.ACCT_CODE', '<>', $request->code)
            ->where(DB::raw("NVL(A.ACCT_PARENT, '~')"), '<>', $request->code)
            ->get();

        $acct_name = $request->acct_name;
        $table = DB::table('ACCT_MENU')
            ->selectRaw('*')
            ->where('ACCT_NAME', '=', $acct_name)
            ->get();

        $search = $request->search;
        $menu = DB::table('ACCT_MENU')
            ->selectRaw('LVL, ACCT_NAME, ACCT_CODE')
            ->where('ACCT_NAME', 'LIKE', '%' . $search . '%')
            ->get();

        $akun = '';
        $filter = $request->filter;
        if($request->akun == "B") {
            // Akun NERACA
            $akun = DB::select(DB::raw("
            SELECT -1, LEVEL, acct_name, NULL, a.acct_code
            FROM  fs_mst_account a
            WHERE a.acct_type_jurnal in ('A', 'L', 'O')
                AND a.acct_code IN (
                    SELECT b.acct_code
                        FROM fs_mst_account b
                    CONNECT BY PRIOR b.acct_parent = b.acct_code
                    START WITH (b.acct_code) IN (
                                SELECT d.acct_code
                                FROM  fs_mst_account d
                                WHERE ((d.acct_status  = 'AC' AND :filter = 'E')
                                        OR (d.acct_status = 'NA' AND :filter = 'D')
                                        OR (:filter = 'A'))
                                    ))
            CONNECT BY PRIOR a.acct_code = a.acct_parent
            START WITH (a.acct_code) IN (SELECT c.acct_code
                                    FROM fs_mst_account c
                                    WHERE c.acct_parent IS NULL)
            ORDER SIBLINGS BY a.acct_code"),
                array('filter' => $filter)
            );
        }else if($request->akun == "I") {
            // Akun RUGI LABA
            $akun = DB::select(DB::raw("
            SELECT -1, LEVEL, acct_name, NULL, a.acct_code								
            FROM  fs_mst_account a								
            WHERE a.acct_type_jurnal in ('R','E')								
            AND a.acct_code IN (								
                    SELECT b.acct_code								
                        FROM fs_mst_account b								
                    CONNECT BY PRIOR b.acct_parent = b.acct_code								
                    START WITH (b.acct_code) IN (								
                                SELECT d.acct_code								
                                    FROM fs_mst_account d								
                                WHERE ((d.acct_status = 'Y' AND :filter = 'E')								
                                        OR (d.acct_status = 'N' AND :filter = 'D')								
                                        OR (:filter = 'A')								
                                        )))								
            CONNECT BY PRIOR a.acct_code = a.acct_parent								
            START WITH (a.acct_code) IN (SELECT c.acct_code								
                                    FROM  fs_mst_account c								
                                    WHERE c.acct_parent IS NULL)								
            ORDER SIBLINGS BY a.acct_code"),
                array('filter' => $filter)
            );
        }

        return response()->json([
            'parent' => $parent,
            'table' => $table,
            'menu' => $menu,
            'akun' => $akun
        ]);
    }

    public function getOutlet()
    {
        $dual = DB::table('DUAL')->selectRaw("'ALL' OFFICE_CODE, 'ALL OUTLET' NAME_SHORT");

        $outlet = DB::table('FS_MST_OFFICES A')
            ->selectRaw('A.OFFICE_CODE, A.NAME_SHORT')
            ->union($dual)
            ->get();

        return response()->json([
            'outlet' => $outlet,
        ]);
    }
}
