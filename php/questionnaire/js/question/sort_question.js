$(function() {
    $(".question_sort .waiting_item").on("click",".item",function() {
        $(this).parent(".waiting_item").siblings(".choosed_item").append($(this));
    });
    $(".question_sort .choosed_item").on("click",".item",function() {
        $(this).parent(".choosed_item").siblings(".waiting_item").append($(this));
    });
});
