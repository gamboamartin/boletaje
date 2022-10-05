let url = getAbsolutePath();

let session_id = getParameterByName('session_id');



let txt_am = $('#am');
let txt_ap = $('#ap');
let txt_nombre = $('#nombre');
let txt_nombre_completo = $('#nombre_completo');

let am = '';
let ap = '';
let nombre = '';
let nombre_completo = '';

txt_am.change(function(){
    am = $(this).val();
    nombre_completo = nombre+' '+ap+' '+am;
    txt_nombre_completo.val(nombre_completo);

});

txt_ap.change(function(){
    ap = $(this).val();
    nombre_completo = nombre+' '+ap+' '+am;
    txt_nombre_completo.val(nombre_completo);

});

txt_nombre.change(function(){
    nombre = $(this).val();
    nombre_completo = nombre+' '+ap+' '+am;
    txt_nombre_completo.val(nombre_completo);

});






