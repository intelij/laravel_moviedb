$(document).ready(function () {
    //remove current actors from all actors select
    $("#current_actors option").each(function () {
        var $this = $(this);
        var val = $this.val();

        $("#actors option").each(function () {
            var $this = $(this);
            if($this.val() == val)
            {
                $this.remove();
            }
        });
    });
    //remove current genres from all genres select
    $("#current_genres option").each(function () {
        var $this = $(this);
        var val = $this.val();

        $("#genres option").each(function () {
            var $this = $(this);
            if($this.val() == val)
            {
                $this.remove();
            }
        });
    });

    $("#remove_current_actor").click(function (event) {
        event.preventDefault();

        $("#current_actors option:selected").each(function () {
            var $this = $(this);

            $("#actors").append($('<option>',{value:$this.val(),text:$this.text()}));
        });

        $('#current_actors option:selected').remove()


    });

    $("#add_current_actor").click(function (event) {
        event.preventDefault();

        $("#actors option:selected").each(function () {
            var $this = $(this);

            $("#current_actors").append($('<option>',{value:$this.val(),text:$this.text()}));
        });

        $('#actors option:selected').remove()

    });

    $("#remove_current_genre").click(function (event) {
        event.preventDefault();

        $("#current_genres option:selected").each(function () {
            var $this = $(this);

            $("#genres").append($('<option>',{value:$this.val(),text:$this.text()}));
        });

        $('#current_genres option:selected').remove()


    });

    $("#add_current_genre").click(function (event) {
        event.preventDefault();

        $("#genres option:selected").each(function () {
            var $this = $(this);

            $("#current_genres").append($('<option>',{value:$this.val(),text:$this.text()}));
        });

        $('#genres option:selected').remove()

    });
    
    $("form").submit(function () {
        $("#current_actors option").each(function () {
            var $this = $(this);

            $this.prop('selected', true);
        });

        $("#current_genres option").each(function () {
            var $this = $(this);

            $this.prop('selected', true);
        });
    })


});