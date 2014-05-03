function SearchableTicketTable(ticketTable) {
    this.$table = $(ticketTable);

    //Calculate header indices.
    this.headerIndexArray = {};
    this.tableHeaders = $(this.$table.find('th'));
    this.widgets = [];

    if (this.tableHeaders.length > 1) {
        for (var i = 0; i < this.tableHeaders.length; i++) {
            this.headerIndexArray[$(this.tableHeaders[i]).data('ticket-field')] = i;
        }
    } else if (this.tableHeaders.length == 1) {
        this.headerIndexArray[$(this.tableHeaders).data('ticket-field')] = 0;
    }

    this.getValuesAsArray = function (ticketFieldString) {
        var index = this.headerIndexArray[ticketFieldString];
        var valuesHash = {};
        this.$table.find('tr').each(

                function () {
                    var cells = $($(this).children('td'));
                    var cellVal;
                    if (cells.length === 0) {
                        return;
                    }
                    if (cells.length == 1) {
                        cellVal = cells.html();
                    } else {
                        var $cell = $(cells[index]);
                        cellVal = $cell.html();
                    }
                    valuesHash[cellVal] = 1;
                });
        return $.map(valuesHash, function(val, key){
            return key;
        });
    };

    this.search = function (ticketField, query) {
        var index = this.headerIndexArray[ticketField];
        this.$table.find('tr:visible').each(

                function () {
                    var cells = $($(this).children('td'));
                    var cellVal;
                    if (cells.length === 0) {
                        return;
                    }
                    if (cells.length == 1) {
                        cellVal = cells.html();
                    } else {
                        $cell = $(cells[index]);
                        cellVal = $cell.html();
                        alert(cellVal);
                    }
                    if (cellVal != query) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
    };
    this.clearSearch = function () {
        this.$table.find('tr').each(

                function () {
                    $(this).show();
                });
    };

    this.addSelector = function (ticketField) {
        var selector = new SelectorWidget(ticketField, this.getValuesAsArray(ticketField), this);
        this.widgets.push(selector);
        return selector;
    };
    this.searchForm = function () {
        $form = $("<form/>");
        for (var i = 0; i < this.widgets.length; i++) {
            var selector = this.widgets[i];
            var $myDiv = $("<div/>");
            $myDiv.attr('id', selector.$selector.attr('id') + "container");
            var $label = $("<label/>").attr("for", $myDiv.id);
            $myDiv.append($label);
            $myDiv.append(selector.$selector);
            $form.append($myDiv);
        }
        return $form;
    };
}

function SelectorWidget(ticketField, options, parentTable) {
    this.options = options;
    this.searchableTicketTable = parentTable;
    this.ticketField = ticketField;
    this.$selector = $("<select/>");
    this.$selector.attr('id', this.searchableTicketTable.$table.attr('id') + "-" + this.ticketField + "-" + "selector");
    this.$selector.append('<option selected value="">All</option>');
    for (var i = 0; i < options.length; i++) {
        this.$selector.append('<option value="'+ options[i]+'">'+options[i]+"</option>");
    }
}

