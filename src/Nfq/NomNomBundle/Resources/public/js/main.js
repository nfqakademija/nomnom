function addGenemuFunctionality($obj){
    $($obj).val(["AL","AZ"])
        .select2()
        .select2({width: 'resolve'})
        .click(function() { $($obj).select2(); });
    $("#wait_tags_destroy").click(function() { $("#wait_").select2("destroy"); });
}

function addProductForm($collectionHolder) {

    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    //so that recipe products start from 1 not from 0
    if(index == 0) index++;

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index)
        .replace(/label__/g, '');

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);
    $collectionHolder.append(newForm);
    //adding genemufunctionality to newly created form element
    var name = "#createrecipe_myRecipeProducts_"+index+"_myProduct";
    addGenemuFunctionality(name);
}

