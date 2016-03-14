<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "er_nursing_detail".
 *
 * @property string $vn
 * @property string $arrive_time
 * @property string $referin_person
 * @property string $trauma
 * @property string $bba
 * @property string $dba
 * @property string $psychic
 * @property string $revisit48hr
 * @property double $gcs_e
 * @property double $gcs_v
 * @property double $gcs_m
 * @property double $pupil_l
 * @property double $pupil_r
 * @property string $inform_person
 * @property string $interview_person
 * @property string $report_doctor_time
 * @property string $doctor_finish_time
 * @property string $support_information
 * @property string $visit_type
 * @property string $transporter
 * @property integer $er_accident_type_id
 * @property integer $er_emergency_type
 * @property integer $er_refer_hosptype_id
 * @property integer $er_refer_sender_id
 * @property string $discharge_date
 * @property string $discharge_time
 * @property string $admit_2hr
 * @property integer $er_transfer_hosptype_id
 * @property string $accident_in_province
 * @property string $accident_admit
 * @property string $accident_dead_before_arrive
 * @property string $accident_dead_in_hospital
 * @property integer $accident_transport_type_id
 * @property integer $accident_type_1
 * @property integer $accident_type_2
 * @property integer $accident_type_3
 * @property string $hos_guid
 * @property integer $accident_type_4
 * @property integer $accident_type_5
 * @property integer $accident_type_6
 * @property double $o2sat
 * @property integer $accident_place_type_id
 * @property integer $accident_person_type_id
 * @property integer $accident_alcohol_type_id
 * @property integer $accident_drug_type_id
 * @property integer $accident_airway_type_id
 * @property integer $accident_bleed_type_id
 * @property integer $accident_belt_type_id
 * @property integer $accident_helmet_type_id
 * @property integer $accident_splint_type_id
 * @property integer $accident_fluid_type_id
 * @property string $accident_note_text
 * @property string $accident_gis_lat
 * @property string $accident_gis_long
 */
class ErNursingDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'er_nursing_detail';
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
            [['vn'], 'required'],
            [['arrive_time', 'report_doctor_time', 'doctor_finish_time', 'discharge_date', 'discharge_time'], 'safe'],
            [['gcs_e', 'gcs_v', 'gcs_m', 'pupil_l', 'pupil_r', 'o2sat'], 'number'],
            [['er_accident_type_id', 'er_emergency_type', 'er_refer_hosptype_id', 'er_refer_sender_id', 'er_transfer_hosptype_id', 'accident_transport_type_id', 'accident_type_1', 'accident_type_2', 'accident_type_3', 'accident_type_4', 'accident_type_5', 'accident_type_6', 'accident_place_type_id', 'accident_person_type_id', 'accident_alcohol_type_id', 'accident_drug_type_id', 'accident_airway_type_id', 'accident_bleed_type_id', 'accident_belt_type_id', 'accident_helmet_type_id', 'accident_splint_type_id', 'accident_fluid_type_id'], 'integer'],
            [['accident_note_text'], 'string'],
            [['vn'], 'string', 'max' => 13],
            [['referin_person', 'inform_person', 'interview_person', 'transporter', 'accident_gis_lat', 'accident_gis_long'], 'string', 'max' => 50],
            [['trauma', 'bba', 'dba', 'psychic', 'revisit48hr', 'visit_type', 'admit_2hr', 'accident_in_province', 'accident_admit', 'accident_dead_before_arrive', 'accident_dead_in_hospital'], 'string', 'max' => 1],
            [['support_information'], 'string', 'max' => 250],
            [['hos_guid'], 'string', 'max' => 38]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vn' => 'Vn',
            'arrive_time' => 'Arrive Time',
            'referin_person' => 'Referin Person',
            'trauma' => 'Trauma',
            'bba' => 'Bba',
            'dba' => 'Dba',
            'psychic' => 'Psychic',
            'revisit48hr' => 'Revisit48hr',
            'gcs_e' => 'Gcs E',
            'gcs_v' => 'Gcs V',
            'gcs_m' => 'Gcs M',
            'pupil_l' => 'Pupil L',
            'pupil_r' => 'Pupil R',
            'inform_person' => 'Inform Person',
            'interview_person' => 'Interview Person',
            'report_doctor_time' => 'Report Doctor Time',
            'doctor_finish_time' => 'Doctor Finish Time',
            'support_information' => 'Support Information',
            'visit_type' => 'Visit Type',
            'transporter' => 'Transporter',
            'er_accident_type_id' => 'Er Accident Type ID',
            'er_emergency_type' => 'Er Emergency Type',
            'er_refer_hosptype_id' => 'Er Refer Hosptype ID',
            'er_refer_sender_id' => 'Er Refer Sender ID',
            'discharge_date' => 'Discharge Date',
            'discharge_time' => 'Discharge Time',
            'admit_2hr' => 'Admit 2hr',
            'er_transfer_hosptype_id' => 'Er Transfer Hosptype ID',
            'accident_in_province' => 'Accident In Province',
            'accident_admit' => 'Accident Admit',
            'accident_dead_before_arrive' => 'Accident Dead Before Arrive',
            'accident_dead_in_hospital' => 'Accident Dead In Hospital',
            'accident_transport_type_id' => 'Accident Transport Type ID',
            'accident_type_1' => 'Accident Type 1',
            'accident_type_2' => 'Accident Type 2',
            'accident_type_3' => 'Accident Type 3',
            'hos_guid' => 'Hos Guid',
            'accident_type_4' => 'Accident Type 4',
            'accident_type_5' => 'Accident Type 5',
            'accident_type_6' => 'Accident Type 6',
            'o2sat' => 'O2sat',
            'accident_place_type_id' => 'Accident Place Type ID',
            'accident_person_type_id' => 'Accident Person Type ID',
            'accident_alcohol_type_id' => 'Accident Alcohol Type ID',
            'accident_drug_type_id' => 'Accident Drug Type ID',
            'accident_airway_type_id' => 'Accident Airway Type ID',
            'accident_bleed_type_id' => 'Accident Bleed Type ID',
            'accident_belt_type_id' => 'Accident Belt Type ID',
            'accident_helmet_type_id' => 'Accident Helmet Type ID',
            'accident_splint_type_id' => 'Accident Splint Type ID',
            'accident_fluid_type_id' => 'Accident Fluid Type ID',
            'accident_note_text' => 'Accident Note Text',
            'accident_gis_lat' => 'Accident Gis Lat',
            'accident_gis_long' => 'Accident Gis Long',
        ];
    }
}
