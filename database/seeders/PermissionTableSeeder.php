<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            //sidenav

            'dashboard' => 'side_nav',
            //Master
            'master' => 'side_nav',

            //Druginward

            'druginward' => 'side_nav',

            //Reception
            'reception' => 'side_nav',

            //Doctors
            'doctors' => 'side_nav',

            //laboratory
            'laboratory' => 'side_nav',

            //pharmacy
            'pharmacy' => 'side_nav',

            //Report
            'report' => 'side_nav',

            //settings
            'settings' => 'side_nav',

            //trackings
            'trackings' => 'side_nav',
            'logininfo' => 'side_nav',
            'useractivity' => 'side_nav',

            //master

            //allergy
            'allergy-list' => 'allergy',
            'allergy-edit' => 'allergy',
            'allergy-create' => 'allergy',
            'allergy-show' => 'allergy',

            //diagnosis
            'diagnosis-list' => 'diagnosis',
            'diagnosis-edit' => 'diagnosis',
            'diagnosis-create' => 'diagnosis',
            'diagnosis-show' => 'diagnosis',

            //laboratory
            'labinvestigation-list' => 'labinvestigation',
            'labinvestigation-edit' => 'labinvestigation',
            'labinvestigation-create' => 'labinvestigation',
            'labinvestigation-show' => 'labinvestigation',

            // drug
            'drug-list' => 'drug',
            'drug-edit' => 'drug',
            'drug-create' => 'drug',
            'drug-show' => 'drug',

            //physicalandgeneralexam
            'physicalandgeneralexam-list' => 'physicalandgeneralexam',
            'physicalandgeneralexam-edit' => 'physicalandgeneralexam',
            'physicalandgeneralexam-create' => 'physicalandgeneralexam',
            'physicalandgeneralexam-show' => 'physicalandgeneralexam',

            //village
            'village-list' => 'village',
            'village-edit' => 'village',
            'village-create' => 'village',
            'village-show' => 'village',

            //illness
            'illness-list' => 'illness',
            'illness-edit' => 'illness',
            'illness-create' => 'illness',
            'illness-show' => 'illness',

            //Drug Inward

            // Supplier
            'supplier-list' => 'supplier',
            'supplier-edit' => 'supplier',
            'supplier-create' => 'supplier',
            'supplier-show' => 'supplier',

            //Inward

            'inward-list' => 'inward',
            'inward-edit' => 'inward',
            'inward-create' => 'inward',
            'inward-show' => 'inward',

            //pharmacystock

            'pharmacystock-list' => 'pharmacystock',

            //Reception

            //enrollement
            'patientenrollment-list' => 'patientenrollment',
            'patientenrollment-edit' => 'patientenrollment',
            'patientenrollment-create' => 'patientenrollment',
            'patientenrollment-show' => 'patientenrollment',
            'patientenrollment-token' => 'patientenrollment',

            //enrollment history
            'patientenrollmenthistory-list' => 'patientenrollmenthistory',

            //vitals
            'patientenrollmentvitalshistory-list' => 'patientenrollmentvitalshistory',

            //doctor

            //patient
            'patientdoctor-list' => 'patientdoctor',
            'patientdoctor-edit' => 'patientdoctor',
            'patientdoctor-show' => 'patientdoctor',
            'patientdoctor-create' => 'patientdoctor',

            //patient history

            'patientdoctorhistory-list' => 'patientdoctorhistory',
            'patientdoctorhistory-show' => 'patientdoctorhistory',

            //laboratory

            //patient
            'patientlab-list' => 'patientlab',
            'patientlab-create' => 'patientlab',
            'patientlab-edit' => 'patientlab',
            'patientlab-show' => 'patientlab',

            //patient history
            'patientlabhistory-list' => 'patientlabhistory',

            //pharmacy

            //patient
            'patientpharmacy-list' => 'patientpharmacy',
            'patientpharmacy-edit' => 'patientpharmacy',
            'patientpharmacy-show' => 'patientpharmacy',
            'patientpharmacy-create' => 'patientpharmacy',

            //patient history
            'patientpharmacyhistory-list' => 'patientpharmacyhistory',

            //report

            //enrollmentreport
            'patientenrollmentreport-list' => 'patientenrollmentreport',

            //vitalreport
            'patientvitalreport-list' => 'patientvitalreport',

            //diagnosisreport
            'diagnosisreport-list' => 'diagnosisreport',

            //labreport
            'labreport-list' => 'labreport',

            //expiryreport
            'expirydrugreport-list' => 'expirydrugreport',

            //expiryreport
            'expiryalertdrugreport-list' => 'expiryalertdrugreport',

            //settings
            'settingsuser' => 'settings',
            'settingsadmincongifuraton' => 'settings',
            'settingsclearcache' => 'settings',
            'settingssysteminfo' => 'settings',
            'settingsbackup' => 'settings',
            'setingsrolesandpremission' => 'settings',

            //configuration
            'settingsconfiguration' => 'settings',

            'addemployee-list' => 'settings',
            'addemployee-create' => 'settings',
            'addemployee-edit' => 'settings',
            'addemployee-show' => 'settings',
            'addemployee-show' => 'settings',

            'changepassword' => 'settings',

            //Tracking info
            'logininfo' => 'logininfo',
            'useractivity' => 'useractivity',

            //Role
            'role-list' => 'role',
            'role-create' => 'role',
            'role-edit' => 'role',
            'role-show' => 'role',

        ];

        foreach ($permissions as $key => $value) {
            Permission::create(['name' => $key, 'permissionsheading' => $value]);
        }
    }
}
