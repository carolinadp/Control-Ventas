function ComboBoxItemClick(t, textBoxValueID, textBoxDisplayID) {
    console.log("hola")  
    var v = $(t).attr('data-value');
     var elid = "#" + textBoxValueID;
     $(elid).val(v);

    v = $(t).text();
    elid = "#" + textBoxDisplayID;
    $(elid).val(v);


}