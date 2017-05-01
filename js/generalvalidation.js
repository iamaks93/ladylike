/**
 * Created by Maa on 3/5/2017.
 */
/* @use : Validate country form controls*/
function ValidateCountry(formid)
{

    if(validatecontrol("#" + formid + " #txtCountryCode","<b>Please enter country code.</b>","empty",formid,"#ErrorCountryDiv") == 0)
    {
        showNotificationMsg('Please enter country code.',true,'error');
        return false;
    }
    if(validatecontrol("#" + formid + " #txtCountryName","<b>Please enter country name.</b>","empty",formid,"#ErrorCountryDiv") == 0)
    {
        showNotificationMsg('Please enter country name.',true,'error');
        return false;
    }
    return true;
}
/* @use : Validate state form controls*/
function ValidateState(formid)
{
    if(validatecontrol("#" + formid + " #txtStateCode","<b>Please enter state code.</b>","empty",formid,"#ErrorStateDiv") == 0)
    {
        showNotificationMsg('Please enter state code.',true,'error');
        return false;
    }
    if(validatecontrol("#" + formid + " #txtStateName","<b>Please enter state name.</b>","empty",formid,"#ErrorStateDiv") == 0)
    {
        showNotificationMsg('Please enter state name.',true,'error');
        return false;
    }
    if(validatecontrol("#" + formid + " #ddlbCountry","<b>Please select country.</b>","dropdown",formid,"#ErrorStateDiv") == 0)
    {
        showNotificationMsg('Please select country.',true,'error');
        return false;
    }
    return true;
}
/* @use : Validate city form controls*/
function ValidateCity(formid)
{
    if(validatecontrol("#" + formid + " #txtCityCode","<b>Please enter city code.</b>","empty",formid,"#ErrorCityDiv") == 0)
    {
        showNotificationMsg('Please enter city code.',true,'error');
        return false;
    }
    if(validatecontrol("#" + formid + " #txtCityName","<b>Please enter city name.</b>","empty",formid,"#ErrorCityDiv") == 0)
    {
        showNotificationMsg('Please enter city name.',true,'error');
        return false;
    }
    if(validatecontrol("#" + formid + " #ddlbCountry","<b>Please select country.</b>","dropdown",formid,"#ErrorCityDiv") == 0)
    {
        showNotificationMsg('Please select country.',true,'error');
        return false;
    }
    if(validatecontrol("#" + formid + " #ddlbState","<b>Please select state.</b>","dropdown",formid,"#ErrorCityDiv") == 0)
    {
        showNotificationMsg('Please select state.',true,'error');
        return false;
    }

    return true;
}
/* @use : Validate city form controls*/
function ValidateTaluka(formid)
{
    if(validatecontrol("#" + formid + " #txtTalukaCode","<b>Please enter taluka code.</b>","empty",formid,"#ErrorTalukaDiv") == 0)
    {
        showNotificationMsg('Please enter taluka code.',true,'error');
        return false;
    }
    if(validatecontrol("#" + formid + " #txtTalukaName","<b>Please enter taluka name.</b>","empty",formid,"#ErrorTalukaDiv") == 0)
    {
        showNotificationMsg('Please enter taluka name.',true,'error');
        return false;
    }
    if(validatecontrol("#" + formid + " #ddlbCountry","<b>Please select country.</b>","dropdown",formid,"#ErrorTalukaDiv") == 0)
    {
        showNotificationMsg('Please select country.',true,'error');
        return false;
    }
    if(validatecontrol("#" + formid + " #ddlbState","<b>Please select state.</b>","dropdown",formid,"#ErrorTalukaDiv") == 0)
    {
        showNotificationMsg('Please select state.',true,'error');
        return false;
    }
    return true;
}
/* @use : Validate speciality form controls*/
function ValidateSpeciality(formid)
{
    if(validatecontrol("#" + formid + " #txtSpecialityCode","<b>Please enter speciality code.</b>","empty",formid,"#ErrorSpecialityDiv") == 0)
    {
        showNotificationMsg('Please enter speciality code.',true,'error');
        return false;
    }
    if(validatecontrol("#" + formid + " #txtSpecialityName","<b>Please enter speciality name.</b>","empty",formid,"#ErrorSpecialityDiv") == 0)
    {
        showNotificationMsg('Please enter speciality name.',true,'error');
        return false;
    }
    return true;
}
/* @use : Validate Hospital form controls*/
function ValidateHospital(formid)
{

    if(validatecontrol("#" + formid + " #txtHospitalName","<b>Please enter hospital name.</b>","empty",formid,"#ErrorHospitalDiv") == 0)
    {
        showNotificationMsg('Please enter hospital name.',true,'error');
        return false;
    }
    if(validatecontrol("#" + formid + " #txtStdCode","<b>Please enter correct std code.</b>","number",formid,"#ErrorHospitalDiv") == 0)
    {
        showNotificationMsg('Please enter correct std code.',true,'error');
        return false;
    }
    if(validatecontrol("#" + formid + " #txtPhoneNo","<b>Please enter correct phone no.</b>","number",formid,"#ErrorHospitalDiv") == 0)
    {
        showNotificationMsg('Please enter correct phone no.',true,'error');
        return false;
    }

    if(validatecontrol("#" + formid + " #txtMobile","<b>Please enter correct mobile no.</b>","number",formid,"#ErrorHospitalDiv") == 0)
    {
        showNotificationMsg('Please enter correct mobile no.',true,'error');
        return false;
    }

    if(validatecontrol("#" + formid + " #txtEmail","<b>Please enter correct email.</b>","email",formid,"#ErrorHospitalDiv") == 0)
    {
        showNotificationMsg('Please enter correct email.',true,'error');
        return false;
    }

    if(validatecontrol("#" + formid + " #txtWebsite","<b>Please enter correct website.</b>","url",formid,"#ErrorHospitalDiv") == 0)
    {
        showNotificationMsg('Please enter correct website.',true,'error');
        return false;
    }
    if(validatecontrol("#" + formid + " #ddlbCity","<b>Please select city.</b>","dropdown",formid,"#ErrorHospitalDiv") == 0)
    {
        showNotificationMsg('Please select city.',true,'error');
        return false;
    }

    return true;
}

/* @use : Validate Doctor form controls*/
function ValidateDoctor(formid)
{
    if(validatecontrol("#" + formid + " #txtDoctorName","<b>Please enter doctor name.</b>","empty",formid,"#BasicDetailErrorDoctorDiv") == 0)
    {
        showNotificationMsg('Please enter doctor name.',true,'error');
        return false;
    }
    if(validatecontrol("#" + formid + " #ddlbHospitalName","<b>Please select hospital.</b>","dropdown",formid,"#BasicDetailErrorDoctorDiv") == 0)
    {
        showNotificationMsg('Please select hospital.',true,'error');
        return false;
    }
    if(validatecontrol("#" + formid + " #txtDoctorEmail","<b>Please enter correct email.</b>","email",formid,"#BasicDetailErrorDoctorDiv") == 0)
    {
        showNotificationMsg('Please enter correct email.',true,'error');
        return false;
    }
    if(validatecontrol("#" + formid + " #txtMobileNo","<b>Please enter mobile no.</b>","empty",formid,"#BasicDetailErrorDoctorDiv") == 0)
    {
        showNotificationMsg('Please enter mobile no.',true,'error');
        return false;
    }
    if(validatecontrol("#" + formid + " #txtMobileNo","<b>Please enter correct mobile no.</b>","number",formid,"#BasicDetailErrorDoctorDiv") == 0)
    {
        showNotificationMsg('Please enter correct mobile no.',true,'error');
        return false;
    }
    if(validatecontrol("#" + formid + " #ddlbResidentCity","<b>Please select city.</b>","dropdown",formid,"#BasicDetailErrorDoctorDiv") == 0)
    {
        showNotificationMsg('Please select city.',true,'error');
        return false;
    }
    if(validatecontrol("#" + formid + " #txtResidentStdCode","<b>Please enter correct std code.</b>","number",formid,"#BasicDetailErrorDoctorDiv") == 0)
    {
        showNotificationMsg('Please enter correct std code.',true,'error');
        return false;
    }
    if(validatecontrol("#" + formid + " #txtResidentPhoneNo","<b>Please enter correct phone no.</b>","number",formid,"#BasicDetailErrorDoctorDiv") == 0)
    {
        showNotificationMsg('Please enter correct phone no.',true,'error');
        return false;
    }

    return true;
}
