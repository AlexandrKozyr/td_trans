(function ($, window) {
    var jLettersCont = $('.js-catalog_letters');
    if (!jLettersCont.length) {
        return;
    }
    var oSels = {
        Letter: '.js-catalog_letter',
        Box: '.js-catalog_letter_box',
        Tooltip: '.js-catalog_letter_tooltip'
    }
    var sShownClass = 'tooltip_show';
    var jCurrentLetter = null, hideTiomeout = 2e3, hideTimerId;
    function getLetterTooltip(jLetter) {
        return jLetter.parents(oSels.Box).find(oSels.Tooltip);
    }
    function hideCurrentTooltip() {
        if (hideTimerId) {
            clearTimeout(hideTimerId);
            hideTimerId = null;
        }
        if (jCurrentLetter !== null) {
            getLetterTooltip(jCurrentLetter).removeClass(sShownClass);
            jCurrentLetter = null;
        }
    }
    function showLetterTooltip(jLetter) {
        if (jCurrentLetter !== null) {
            hideCurrentTooltip();
        }
        getLetterTooltip(jLetter).addClass(sShownClass);
        //hideTimerId = setTimeout(hideCurrentTooltip, hideTiomeout);
        jCurrentLetter = jLetter;
    }
    jLettersCont.on('mouseover', oSels.Letter, function (e) {
        var jLetter = $(this);
        showLetterTooltip(jLetter);
        e.preventDefault();
    }).on('mouseover mouseout', [oSels.Tooltip, oSels.Letter].join(','), function (e) {
        var jTarget = $(this);
        if (jCurrentLetter === null ||
                (jTarget.is(oSels.Letter) && jCurrentLetter.get(0) !== this) ||
                (jTarget.is(oSels.Tooltip) && getLetterTooltip(jCurrentLetter).get(0) !== this)
                ) {
            return;
        }
        var bIsOver = e.type === 'mouseover';
        if (bIsOver) {
            clearTimeout(hideTimerId);
            hideTimerId = null;
        } else {
            hideTimerId = setTimeout(hideCurrentTooltip, hideTiomeout);
        }
    });
    // js-catalog_letter_tooltip
}(this.jQuery, this));
