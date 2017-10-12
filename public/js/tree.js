$.fn.extend({
    treed: function (o) {

        var openedClass = 'glyphicon-minus-sign';
        var closedClass = 'glyphicon-plus-sign';

        if (typeof o != 'undefined') {
            if (typeof o.openedClass != 'undefined') {
                openedClass = o.openedClass;
            }
            if (typeof o.closedClass != 'undefined') {
                closedClass = o.closedClass;
            }
        }
        ;

        //initialize each of the top levels
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this); //li with children ul
            if ($(this).find('ul').html() != "")
                branch.prepend("<i class='indicator glyphicon " + openedClass + "'></i>");
            else
                branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this == e.target) {
                    var icon = $(this).children('i:first');
                    if ($(this).find('ul').html() != "")
                    {
                        icon.toggleClass(openedClass + " " + closedClass);
                        $(this).children().children().toggle();
                    } else
                    {
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url: '/',
                            type: 'POST',
                            data: {_token : _token, id: $(this).attr('name')},
                            async: true,
                            success: function (data) {
                                if (data)
                                {
                                    $(e.target).find('ul').html(data);
                                    $(e.target).find('ul').treed();
                                    icon.toggleClass(openedClass + " " + closedClass);
                                } else
                                    icon.remove();
                            },
                        });

                    }
                }
            })
        });
        //fire event from the dynamically added icon
        tree.find('.branch .indicator').each(function () {
            $(this).on('click', function () {
                $(this).closest('li').click();
            });
        });
        //fire event to open branch if the li contains an anchor instead of text
        tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
        //fire event to open branch if the li contains a button instead of text
        tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
    }
});

//Initialization of treeviews

$('#tree').treed();