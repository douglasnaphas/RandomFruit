/**
 * @function SearchableTicketTable -- Adds searching widgets to a ticket table.
 */
function SearchableTicketTable(ticketTable) {
    /**
     * Add a reference to the original table (but as a jquery object
     */
    this.$table = $(ticketTable);

    /**
     * Returns a list of all values in a column. Used for producing widget.
     */
    this.getValuesAsArray = function (ticketFieldString) {
        // Get the index of the ticketField.
        var index = this.headerIndexArray[ticketFieldString];

        // Stores the values as keys
        var valuesHash = {};

        //For each row in the column
        this.$table.find('tr').each(
                function () {
                    //Retrieve all the children
                    var cells = $($(this).children('td'));
                    var cellVal;

                    //Sometimes there aren't any
                    if (cells.length === 0) {
                        return;
                    }

                    //If there is only one child. Assume we're on correct column
                    if (cells.length == 1) {
                        cellVal = cells.html();
                    } 
                    
                    //Otherwise, get value from appropriate column
                    else {
                        var $cell = $(cells[index]);
                        cellVal = $cell.html();
                    }
                    
                    //Add a value at that index so it shows up in keys list
                    valuesHash[cellVal] = 1;
                });

        // Return the list of keys (cell values)
        return $.map(valuesHash, function(val, key){
            return key;
        });
    };

    /**
     * search -- hides all rows in table that don't match a query
     *
     * @param ticketField -- A string that matches a table headers data-ticket-field value
     * @param query -- The value being looked for in that column
     * @param closure -- function(actual, wanted) compares to check if values match
     *
     */
    this.search = function (ticketField, query, closure) {
        //Get the index of the column being searched
        var index = this.headerIndexArray[ticketField];

        // Default closure is a == b
        if(closure == null){
            closure = function (actual, wanted){
                return actual == wanted;
            }

        }

        // For each visible, non-widget row
        this.$table.find('tr:visible').not('.widget').each(

                function () {
                    //Get the cells of the column (potentially array)
                    var cells = $($(this).children('td'));
                    var cellVal;
                    if (cells.length === 0) {
                        return;
                    }

                    // Get the value from the appropriate cell
                    if (cells.length == 1) {
                        cellVal = cells.html();
                    } else {
                        $cell = $(cells[index]);
                        cellVal = $cell.html();
                    }

                    // Hide the row if it doesn't match the comparison
                    if (!closure(cellVal,query)) {
                        $(this).hide();
                    } else {
                        //This one doesn't really do anything
                        $(this).show();
                    }
                });

    };

    // Restores the visibility of all rows
    this.clearSearch = function () {
        this.$table.find('tr').each(

                function () {
                    $(this).show();
                });
    };

    // Runs searches on all widgets
    this.doSearch = function () {
        for(var i = 0; i < this.widgets.length; i++){
            var widget = this.widgets[i];
            widget.doSearch();
        }
    };

    // Creates a widget for a given field and adds it
    // to the list of widgets
    this.addWidget = function (ticketField, type) {
        var widget;
        if(type == "text"){
            widget = new TextWidget(ticketField, this);
        }
        else if(type == "selector"){
            widget = new SelectorWidget(ticketField, this.getValuesAsArray(ticketField), this);
        }
        else{
            widget = new EmptyWidget();
        }
        this.widgets.push(widget);
        return widget;
    };

    // Returns a table row containing all the widgets
    this.searchRow = function () {
        var $row = $("<tr/>");
        $row.addClass('widget');
        for (var i = 0; i < this.widgets.length; i++) {
            var selector = this.widgets[i];
            var $myDiv = $("<td/>");
            $myDiv.attr('id', selector.$selector.attr('id') + "container");
            $myDiv.append(selector.$selector);
            $row.append($myDiv);
        }
        return $row;
    };

    // Adds the search row to the table
    this.addSearchRow = function(){

        $headRow = this.$table.children('thead');
        $headRow.after(this.searchRow());
    };

    // basically, this is the constructor
    this.headerIndexArray = {};
    this.tableHeaders = $(this.$table.find('th'));
    this.widgets = [];
    var typeHash = {};

    if (this.tableHeaders.length > 1) {
        for (var i = 0; i < this.tableHeaders.length; i++) {
            $tableHeader = $(this.tableHeaders[i]);
            this.headerIndexArray[$tableHeader.data('ticket-field')] = i;
            this.addWidget($tableHeader.data('ticket-field'), $tableHeader.data('widget-type'));
        }
    } else if (this.tableHeaders.length == 1) {
        this.headerIndexArray[$(this.tableHeaders).data('ticket-field')] = 0;
    }


}


/**
 * Creates a drop-down widget for a given ticketField
 */
function SelectorWidget(ticketField, options, parentTable) {
    // not necessary
    var searchableTicketTable = parentTable;

    // $this is saved for reasons
    var $myself = this;
    
    //Create a select element
    this.$selector = $("<select/>");

    //Add an "<table-id>-<ticketField>-selector" id
    this.$selector.attr('id', searchableTicketTable.$table.attr('id') + "-" + ticketField + "-" + "selector");

    //Add default "view all" option
    this.$selector.append('<option selected value="">All</option>');

    // Add all possible options
    for (var i = 0; i < options.length; i++) {
        this.$selector.append('<option value="'+ options[i]+'">'+options[i]+"</option>");
    }

    // Conduct the search on the table based on widgets current value
    this.doSearch = function(){
        if(this.$selector.val() !== "")
            parentTable.search(ticketField, this.$selector.val());
    };

    // When the selector is changed
    this.$selector.change(function(){
        // Show all rows
        parentTable.clearSearch();

        // Run all searches (including this one)
        parentTable.doSearch();
    });

    //Returns the TicketField string
    this.getTicketField = function() { return ticketField; };
}

/**
 * A searchable text box
 */
function TextWidget(ticketField, parentTable) {
    var searchableTicketTable = parentTable;
    var $myself = this;
    var closure = function(actual, wanted){
        return actual.indexOf(wanted) > -1;
    }

    // Initiate the actual element
    this.$selector = $('<input type="text"/>');
    this.$selector.attr('id', searchableTicketTable.$table.attr('id') + "-" + ticketField + "-" + "selector");

    // Conduct the search on the table based on widgets current value
    this.doSearch = function(){
        if(this.$selector.val() !== "")
            parentTable.search(ticketField, this.$selector.val(), closure);
    };


    this.$selector.change(function(){
        parentTable.clearSearch();
        parentTable.doSearch();
    });

    this.getTicketField = function() { return ticketField; };
}


/**
 * A placeholder widget
 */
function EmptyWidget(){
    this.$selector = $('');
    this.doSearch = function(){return;};
}

jQuery(function ($){
    $('.ticket-table').each(
        function(){
            var myTable = new SearchableTicketTable($(this));
            myTable.addSearchRow();
        });
});

