$(function(){
    $("#wizard").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        transitionEffectSpeed: 500,
        labels: {
            finish: "Submit",
            next: "Forward",
            previous: "Backward"
        }
    });

    // Forward and Backward button actions
    $('.forward').click(function(){
        $("#wizard").steps('next');
    });

    $('.backward').click(function(){
        $("#wizard").steps('previous');
    });

    // Additional select dropdown handling
    $('html').click(function() {
        $('.select .dropdown').hide(); 
    });

    $('.select').click(function(event){
        event.stopPropagation();
    });

    $('.select .select-control').click(function(){
        $(this).parent().next().toggle();
    });    

    $('.select .dropdown li').click(function(){
        $(this).parent().toggle();
        var text = $(this).attr('rel');
        $(this).parent().prev().find('div').text(text);
    });
});
