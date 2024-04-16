<html>
<head><title>User Names</title>
<script language="javascript" type="text/javascript">

// usernames array
var usernames = new Array("name one","name two","name three","name four","name five");

// character to use as a delimiter
var delim = ",";

// function that takes names string and inserts it into the parant windows textbox
function backAtYa(text) {
    txtarea = window.opener.document.namesForm.namesList;
    if (txtarea.createTextRange && txtarea.caretPos) {
        var caretPos = txtarea.caretPos;
        caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == '' ? text + '' : text;
        txtarea.focus();
        window.close();
    } else {
        txtarea.value += text;
        txtarea.focus();
        window.close();
    }
}

// function that builds the list of names to pass to backAtYa(text)
function buildList(form){
    list = "";
    for(i=0; i<usernames.length; i++){
        if(form.con[i].checked){list+=usernames[i] + delim;}
    }backAtYa(list);
}
</script>
</head>

<body>
<form name="namesList2">
<script language="javascript">
document.write("<strong>User Names</strong><hr />");
for(i=0; i<usernames.length; i++){
    document.write("<input type='checkbox' id='con'>&nbsp;" + usernames[i] + "<br />");
}
</script>
<input type="button" onClick="buildList(this.form)" value="Insert Checked Names">
</form>
</body>
</html>