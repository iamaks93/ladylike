/**
 * Created by Maa on 3/5/2017.
 */


function validatecontrol(id,msg,validation,formid,errordiv)
{
    /*alert(validation);
    return false;*/
    var InputValue = $(id).val();
    var InputLength = $(id).val().length;
    switch (validation)
    {
        case "empty":
        {
           if(InputLength < 1)
           {
              $(errordiv).html(msg);
              $(id).addClass('errorBorder').focus();
              return 0;
           }
           else
           {
               $(errordiv).html('');
               $(id).removeClass('errorBorder');
               return 1;
               break;
           }
        }
        case "dropdown":
        {
            if(InputValue == "" || InputValue == 0 || InputValue == undefined || InputValue == null)
            {
                $(errordiv).html(msg);
                $(id).next().find('.select2-selection').css('border','1px solid red').focus();
                return 0;
            }
            else
            {
                $(errordiv).html('');
                $(id).next().find('.select2-selection').css('border','');
                return 1;
                break;

            }
        }
        case "number":
        {
            if(InputLength > 0)
            {
                if (isNaN(InputValue))
                {
                    $(errordiv).html(msg);
                    $(id).val('');
                    $(id).addClass('errorBorder').focus();
                    return 0;
                }
                else
                {
                    $(errordiv).html('');
                    $(id).removeClass('errorBorder');
                    return 1;
                    break;

                }
            }
        }
        case "email":
        {
            if(InputLength > 0)
            {
                var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
                if (!emailRegex.test(InputValue))
                {
                    $(errordiv).html(msg);
                    $(id).addClass('errorBorder').focus();
                    return 0;
                }
                else
                {
                    $(errordiv).html('');
                    $(id).removeClass('errorBorder');
                    return 1;
                    break;

                }
            }
        }
        case "url":
        {
            if(InputLength > 0)
            {
                var urlregex = new RegExp("^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)");
                if (!urlregex.test(InputValue))
                {
                    $(errordiv).html(msg);
                    $(id).addClass('errorBorder').focus();
                    return 0;
                }
                else
                {
                    $(errordiv).html('');
                    $(id).removeClass('errorBorder');
                    return 1;
                    break;

                }
            }
        }
    }

}
