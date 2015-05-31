isAnimating = false;

function dayatIcon(anim){
    $(document).on('mouseenter', '#dayatIcon',  function(){
        var e = $(this);
        if (isAnimating) return;
        dayatIconate(e, anim);
    });

    $(document).on('mouseleave', '#dayatIcon', function(){
        var e = $(this);
        if (isAnimating) return;
        dayatIconate(e, anim);
    });
}

function dayatIconate(e, anim) {    
    var from = e.attr('class'); 
    var to = e.attr('to');
    
    var iconElement = document.getElementById('dayatIcon');
    var options = {
        from: from,
        to: to,
        animation: anim
    };
    
    isAnimating = true;
    iconate(e[0], options, function(){
        e.attr('to', from);
        isAnimating = false;
    });
}

// call it
dayatIcon('horizontalFlip');