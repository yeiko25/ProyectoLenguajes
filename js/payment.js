$(document).ready(function () {

    target = $(this).attr('href');

    $('.paypal > div').not(target).hide();

    $(target).fadeIn(600);

});

$('.tab a').on('click', function (e) {

    e.preventDefault();

    target = $(this).attr('href');

    $('.card > div').not(target).hide();

    $(target).fadeIn(600);

    target1 = $(this).attr('href');

    $('.paypal > div').not(target).show();

    $(target1).fadeIn(600);

});

$('.tab1 a').on('click', function (e) {

    e.preventDefault();

    target = $(this).attr('href');

    $('.paypal > div').not(target).hide();

    $(target).fadeIn(600);

    target1 = $(this).attr('href');

    $('.card > div').not(target).show();

    $(target1).fadeIn(600);

});