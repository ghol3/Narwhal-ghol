<!--

function numbersonly(e) {

var k = (e.keyCode)? e.keyCode : e.which;
if (k == 8 || k == 46) {
    return true;
    }
if (k < 48 || k > 57) {
return false;
}
}

function sendOrder(form)
{
          if (form.meno.value == "")
          {
          alert("Prosím zadajte Vaše meno");
          form.meno.focus();
          return false;
          }
          if (form.priezvisko.value == "")
          {
          alert("Prosím zadajte Vaše priezvisko");
          form.priezvisko.focus();
          return false;
          }
          if (form.ulica.value == "")
          {
          alert("Prosím zadajte ulicu a číslo");
          form.ulica.focus();
          return false;
          }
          if (form.mesto.value == "")
          {
          alert("Prosím zadajte mesto");
          form.mesto.focus();
          return false;
          }
          if (form.psc.value=="" || form.psc.value.length<5 || !form.psc.value.match(/^\d{5}$/))
          {
          alert ("Zadajte prosím PSČ! (bez medzery napr. 91101)");
          form.psc.focus();
          return false;
          }
          var checkOK = "0123456789";
          var checkStr = form.psc.value;
          var allValid = true;
          var decPoints = 0;
          var allNum = "";
          for (i = 0;  i < checkStr.length;  i++)
          { ch = checkStr.charAt(i);
          for (j = 0;  j < checkOK.length;  j++)
          if (ch == checkOK.charAt(j))
          break;
          if (j == checkOK.length)
          { allValid = false;
          break;
          }
          if (ch == ",")
          { allNum += ".";
          decPoints++;
          }
          else
          allNum += ch;
          }
          if ((!allValid) || (decPoints > 1))
          { alert("Zadajte prosím PSČ!");
          form.psc.focus();
          return (false);
          }
          
          if (form.tel.value == "")
          {
          alert("Prosím zadajte kontaktné telefónne číslo");
          form.tel.focus();
          return false;
          }
          if (form.email.value.indexOf("@") == -1 || form.email.value == "" || form.email.value.indexOf(" ") > -1 || form.email.value.indexOf(".") == -1)
         {
          alert("Prosím zadajte správnu e-mailovů adresu");
          form.email.focus();
          return false;
          }
          if(form.suhlas.checked)
		return true;
	else
	{
		alert('Musíte sůhlasiť s obchodnými podmienkami!');
		return false;
	}
}
//-->
