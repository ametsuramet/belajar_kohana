var  page = $('#page').val()
// console.log(page)
$('#main-menu li[data-menu="'+page+'"]').find('a').addClass('active-menu')