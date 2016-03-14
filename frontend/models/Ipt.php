<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ipt".
 *
 * @property string $an
 * @property string $admdoctor
 * @property string $dchdate
 * @property string $dchstts
 * @property string $dchtime
 * @property string $dchtype
 * @property string $dthdiagdct
 * @property string $hn
 * @property string $ivstist
 * @property string $ivstost
 * @property integer $lockdx
 * @property string $prediag
 * @property string $pttype
 * @property string $regdate
 * @property string $regtime
 * @property string $rfrics
 * @property string $rfrilct
 * @property string $rfrocs
 * @property string $rfrolct
 * @property string $spclty
 * @property string $vn
 * @property string $ward
 * @property string $rcpt_disease
 * @property string $dch_doctor
 * @property integer $ipt_type
 * @property string $iref_type
 * @property integer $ipacc
 * @property double $act_money_limit
 * @property string $drg
 * @property string $mdc
 * @property double $rw
 * @property double $wtlos
 * @property integer $ot
 * @property string $result
 * @property integer $gravidity
 * @property integer $parity
 * @property integer $living_children
 * @property string $rxdoctor
 * @property string $staff
 * @property integer $bw
 * @property string $first_ward
 * @property string $refer_out_number
 * @property string $incharge_doctor
 * @property string $an_guid
 * @property string $an_lock
 * @property string $ergent
 * @property string $chart_state
 * @property string $receive_chart_date_time
 * @property string $receive_chart_staff
 * @property string $receive_chart_note
 * @property double $adjrw
 * @property string $ipt_spclty
 * @property string $finance_lock
 * @property string $last_check_autoincome
 * @property string $admit_fee_guid
 * @property integer $leave_home_day
 * @property string $operation_status
 * @property string $finance_summary_date
 * @property string $estimate_discharge_date
 * @property string $old_cause_revisit
 * @property string $finance_transfer
 * @property string $provision_dx
 * @property integer $dw_hhc_list_id
 * @property string $hos_guid
 * @property string $hos_guid_ext
 * @property integer $body_height
 * @property string $update_datetime
 * @property string $cur_dep_code
 * @property integer $finance_status_flag
 * @property integer $ipt_admit_type_id
 * @property string $no_visit
 * @property string $no_food
 * @property string $confirm_discharge
 * @property string $lab_status
 * @property string $xray_status
 * @property string $grouper_version
 * @property integer $grouper_err
 * @property integer $grouper_warn
 * @property integer $grouper_actlos
 * @property double $auto_charge_amount
 * @property string $provision_dx_icd
 * @property integer $ipt_cause_type_id
 * @property integer $ipt_severe_type_id
 * @property string $ipt_cause_type_note
 * @property string $followup
 * @property integer $dch_severe_type_id
 */
class Ipt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ipt';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('hosxpslave');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['an'], 'required'],
            [['dchdate', 'dchtime', 'regdate', 'regtime', 'receive_chart_date_time', 'last_check_autoincome', 'finance_summary_date', 'estimate_discharge_date', 'update_datetime'], 'safe'],
            [['lockdx', 'ipt_type', 'ipacc', 'ot', 'gravidity', 'parity', 'living_children', 'bw', 'leave_home_day', 'dw_hhc_list_id', 'body_height', 'finance_status_flag', 'ipt_admit_type_id', 'grouper_err', 'grouper_warn', 'grouper_actlos', 'ipt_cause_type_id', 'ipt_severe_type_id', 'dch_severe_type_id'], 'integer'],
            [['act_money_limit', 'rw', 'wtlos', 'adjrw', 'auto_charge_amount'], 'number'],
            [['an', 'hn', 'provision_dx_icd'], 'string', 'max' => 9],
            [['admdoctor', 'dthdiagdct', 'dch_doctor', 'rxdoctor', 'incharge_doctor'], 'string', 'max' => 7],
            [['dchstts', 'dchtype', 'ivstist', 'pttype', 'spclty', 'mdc', 'ipt_spclty'], 'string', 'max' => 2],
            [['ivstost', 'ward', 'iref_type', 'first_ward'], 'string', 'max' => 4],
            [['prediag'], 'string', 'max' => 250],
            [['rfrics', 'rfrocs', 'result', 'an_lock', 'ergent', 'chart_state', 'finance_lock', 'operation_status', 'old_cause_revisit', 'finance_transfer', 'no_visit', 'no_food', 'confirm_discharge', 'lab_status', 'xray_status', 'followup'], 'string', 'max' => 1],
            [['rfrilct', 'rfrolct', 'drg'], 'string', 'max' => 5],
            [['vn'], 'string', 'max' => 13],
            [['rcpt_disease', 'receive_chart_note'], 'string', 'max' => 100],
            [['staff'], 'string', 'max' => 20],
            [['refer_out_number', 'grouper_version'], 'string', 'max' => 15],
            [['an_guid', 'admit_fee_guid', 'hos_guid'], 'string', 'max' => 38],
            [['receive_chart_staff'], 'string', 'max' => 25],
            [['provision_dx'], 'string', 'max' => 200],
            [['hos_guid_ext'], 'string', 'max' => 64],
            [['cur_dep_code'], 'string', 'max' => 3],
            [['ipt_cause_type_note'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'an' => 'An',
            'admdoctor' => 'Admdoctor',
            'dchdate' => 'Dchdate',
            'dchstts' => 'Dchstts',
            'dchtime' => 'Dchtime',
            'dchtype' => 'Dchtype',
            'dthdiagdct' => 'Dthdiagdct',
            'hn' => 'Hn',
            'ivstist' => 'Ivstist',
            'ivstost' => 'Ivstost',
            'lockdx' => 'Lockdx',
            'prediag' => 'Prediag',
            'pttype' => 'Pttype',
            'regdate' => 'Regdate',
            'regtime' => 'Regtime',
            'rfrics' => 'Rfrics',
            'rfrilct' => 'Rfrilct',
            'rfrocs' => 'Rfrocs',
            'rfrolct' => 'Rfrolct',
            'spclty' => 'Spclty',
            'vn' => 'Vn',
            'ward' => 'Ward',
            'rcpt_disease' => 'Rcpt Disease',
            'dch_doctor' => 'Dch Doctor',
            'ipt_type' => 'Ipt Type',
            'iref_type' => 'Iref Type',
            'ipacc' => 'Ipacc',
            'act_money_limit' => 'Act Money Limit',
            'drg' => 'Drg',
            'mdc' => 'Mdc',
            'rw' => 'Rw',
            'wtlos' => 'Wtlos',
            'ot' => 'Ot',
            'result' => 'Result',
            'gravidity' => 'Gravidity',
            'parity' => 'Parity',
            'living_children' => 'Living Children',
            'rxdoctor' => 'Rxdoctor',
            'staff' => 'Staff',
            'bw' => 'Bw',
            'first_ward' => 'First Ward',
            'refer_out_number' => 'Refer Out Number',
            'incharge_doctor' => 'Incharge Doctor',
            'an_guid' => 'An Guid',
            'an_lock' => 'An Lock',
            'ergent' => 'Ergent',
            'chart_state' => 'Chart State',
            'receive_chart_date_time' => 'Receive Chart Date Time',
            'receive_chart_staff' => 'Receive Chart Staff',
            'receive_chart_note' => 'Receive Chart Note',
            'adjrw' => 'Adjrw',
            'ipt_spclty' => 'Ipt Spclty',
            'finance_lock' => 'Finance Lock',
            'last_check_autoincome' => 'Last Check Autoincome',
            'admit_fee_guid' => 'Admit Fee Guid',
            'leave_home_day' => 'Leave Home Day',
            'operation_status' => 'Operation Status',
            'finance_summary_date' => 'Finance Summary Date',
            'estimate_discharge_date' => 'Estimate Discharge Date',
            'old_cause_revisit' => 'Old Cause Revisit',
            'finance_transfer' => 'Finance Transfer',
            'provision_dx' => 'Provision Dx',
            'dw_hhc_list_id' => 'Dw Hhc List ID',
            'hos_guid' => 'Hos Guid',
            'hos_guid_ext' => 'Hos Guid Ext',
            'body_height' => 'Body Height',
            'update_datetime' => 'Update Datetime',
            'cur_dep_code' => 'Cur Dep Code',
            'finance_status_flag' => 'Finance Status Flag',
            'ipt_admit_type_id' => 'Ipt Admit Type ID',
            'no_visit' => 'No Visit',
            'no_food' => 'No Food',
            'confirm_discharge' => 'Confirm Discharge',
            'lab_status' => 'Lab Status',
            'xray_status' => 'Xray Status',
            'grouper_version' => 'Grouper Version',
            'grouper_err' => 'Grouper Err',
            'grouper_warn' => 'Grouper Warn',
            'grouper_actlos' => 'Grouper Actlos',
            'auto_charge_amount' => 'Auto Charge Amount',
            'provision_dx_icd' => 'Provision Dx Icd',
            'ipt_cause_type_id' => 'Ipt Cause Type ID',
            'ipt_severe_type_id' => 'Ipt Severe Type ID',
            'ipt_cause_type_note' => 'Ipt Cause Type Note',
            'followup' => 'Followup',
            'dch_severe_type_id' => 'Dch Severe Type ID',
        ];
    }
}
