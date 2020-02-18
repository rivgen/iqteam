$(document).ready(function(){

    $(".filter-button").click(function(){
        let value = $(this).attr('data-filter');
        let titleVal = $(this).val();
        if(value == "all")
        {
            //$('.filter').removeClass('hidden');
            $('.filter').show('1000');
        }
        else
        {
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');

        }


        if ($(".filter-button").removeClass("active")) {
            $(this).removeClass("active");
        }
        $(this).addClass("active")
        $("#button360vw").html(titleVal)
        // console.log(titleVal)
    });


        // $(this).addClass("active");
});
