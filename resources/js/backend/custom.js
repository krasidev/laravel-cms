/**
 * Function that initializes a image after upload.
 */
$(document).on('change', '[type="file"]', function (e) {
    var url = URL.createObjectURL(e.target.files[0]); 

    $(this).parent().find('img').attr('src', url);
    URL.revokeObjectURL(url);
});

/**
 * Function that initializes a button to delete text in an input field.
 */
$(document).on('input propertychange', '.has-clear input[type="text"]', function () {
    $(this).closest('.has-clear').find('.btn-clear');
}).on('click', '.btn-clear', function () {
    $(this).closest('.has-clear').find('input[type="text"]').val('').trigger('propertychange').focus();
});

/**
 * Function that initializes a blur effect on main content when side nav is open on a mobile resolution.
 */
window.navbarNavInit = function () {
    var buttonNavbarNav = $('[data-target="#navbarNav"]');
    var navbarNav = $('#navbarNav');
    var main = $('#backend main');

    navbarNav.on('show.bs.collapse hide.bs.collapse', function (e) {
        if ($(this).is(e.target)) {
            main.toggleClass('blur', !$(this).hasClass('show'));
        }
    });

    main.on('click', function () {
        if (buttonNavbarNav.is(':visible') && navbarNav.is(':visible')) {
            navbarNav.collapse('hide');
        }
    });
};

/**
 * Function that initializes a search box in side nav.
 */
window.navbarNavSearchInit = function () {
    var backendSideNavGroupULs = $('#backend-side-nav-group ul');
    var backendSideNavGroupULsLinks = backendSideNavGroupULs.find('a');

    $('#backend-side-nav-search').on('keyup propertychange', function () {
        var text = $(this).val().toUpperCase();

        backendSideNavGroupULs.toggleClass('searching', text != '');
        backendSideNavGroupULsLinks.map(function () {
            if (text != '' && this.text.trim().toUpperCase().indexOf(text) > -1) {
                var items = $(this).parents('li');

                items.find('[data-toggle="collapse"]').removeClass('collapsed').attr('aria-expanded', true);
                items.addClass('show-search').find('.collapse').addClass('show');
            } else {
                var link = $(this);

                if (link.attr('data-toggle') == 'collapse') {
                    link.addClass('collapsed').attr('aria-expanded', false);
                }

                link.parent().removeClass('show-search').find('.collapse').removeClass('show');
            }
        });
    });
};

$(function () {
    navbarNavInit();
    navbarNavSearchInit();
});
