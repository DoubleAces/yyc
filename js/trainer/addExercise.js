$(function() {

    /* Enable/disable the add exercise form */
    var exerciseButton = $('#addExercise');
    var exerciseContainer = $('#newExerciseFormContainer');
    exerciseButton.click(function() {
        if (exerciseContainer.css('display') != 'block') {
            exerciseButton.html('Katkesta');
            exerciseButton.removeClass('btn-info').addClass('btn-danger');
        }
        else {
            exerciseButton.html('Lisa uus kava');
            exerciseButton.removeClass('btn-danger').addClass('btn-info');
        }
        exerciseContainer.toggle({
            easing: 'linear'
        });
    });

    /* Adding new image upload boxes */
    $('.upload').live('change', function(e) {
        var currentBox = $(e.currentTarget);
        var currentValue = currentBox.val();
        var currentCounter = parseInt(currentBox.attr('class').split('-')[1]);
        var fileStrBox = $('input[type="text"][class^=file-' + currentCounter + ']');
        var allowedImageCount = $('#exerciseAllowedImageCount').val();

        fileStrBox.val(currentValue);
        if (currentCounter == allowedImageCount) {
            return;
        }
        var nextBox = $('input[type="text"][class^=file-' + (currentCounter + 1) + ']');
        var nextButton = $('input[type="file"][class$=file-' + (currentCounter + 1) + ']');

        if (nextBox.css('display') == 'none') {
            nextBox.removeClass('hidden');
            nextButton.parent().removeClass('hidden');
        }
    });

        /* Magnific */
    $('.exercise-images').each(function() {
        $(this).magnificPopup({
            delegate: 'span a',
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    });

    /* More pics link */
    var morePicsLink = $('.more-pics');
    morePicsLink.click(function() {

        var pics = $(this).parent().parent().find('span');
        if ($(this).hasClass('less')) {
            pics.each(function(i, pic) {
                if (i > 1) {
                    $(pic).hide();
                }
            });
            $(this).removeClass('less').text('Veel pilte');
        }
        else {
            pics.show({easing: 'linear'});
            $(this).addClass('less').text('Vähem pilte');
        }
    });

    /* Add set functionality */
    $('#newExerciseFormContainer').on('click', '#addSetButton', function() {

        /* Find the buttons parent tag to append to */
        var buttonParentElement = $(this).parent();

        /* Enable the 'remove' button */
        $('#removeSetButton').show();

        /* Copy the parents html into a variable so later modifications of it wouldn't get passed to the copied data */
        var parentHtml = buttonParentElement.html();

        $('<p>' + parentHtml + '</p>').insertAfter(buttonParentElement);

    });

    /* Remove set functionality */
    $('#newExerciseFormContainer').on('click', '[id=removeSetButton]', function() {

        /* Remove the parent DOM of the clicked button */
        $(this).parent().remove();

        /* Count the 'remove' buttons and if only 1 found, hide it */
        var removeButtonCount = $('[id=removeSetButton]').length;
        if (removeButtonCount == 1) {
            $('#removeSetButton').hide();
        }

    });
});