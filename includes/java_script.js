function show()
{

    var subject = document.getElementById('subject').value;
    
    alert("enter");

    if (subject != '') 
    {
        $.post('includes/php_script.php',{subject: subject,facshow: 'submit'},function(data){
            $('div#facdisp').html(data);
        });
    }

    else{
        $('div#facdisp').html("<font color='red'>Please Enter The Registration Number</font>");            
    }


}