<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcctMenu extends Model
{
    use HasFactory;
    protected $table = "FS_MST_ACCOUNT";
    protected $fillable = [
        "ACCT_SEQN",
        "ACCT_NAME",
        "ACCT_CODE",
        "ACCT_TYPE_JURNAL",
        "ACCT_SUMM",
        "ACCT_STATUS",
        "ACCT_PARENT",
        "ACCT_FLAG",
        "ACCT_RPT_FLAG",
        "ACCT_OFFICE_CODE",
        "CREATED_BY",
        "CREATED_DATE",
        "UPDATED_BY",
        "UPDATED_DATE",
    ];
    protected $guarded = [];

    public $timestamps = false;
}
