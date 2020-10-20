
function autocomplete2(inp, arr,targetE) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].name.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + arr[i].name.substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].name.substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' data-text='"+arr[i].name+"' value='" + arr[i].id + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function(e) {
                    /*insert the value for the autocomplete text field:*/
                    inp.value = $(this.getElementsByTagName("input")[0]).attr('data-text');
                    targetE.value = this.getElementsByTagName("input")[0].value;
                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        }
    });
    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}

$(document).ready(function(e){
    
    $('.inc-num').on('click', function(e){
        e.preventDefault();
        //console.log($(this).parent().find('input[type="number"]').val().length == 0);
        if($(this).parent().parent().find('input[name="qty"]')[0].value.length == 0)
        {
            $(this).parent().parent().find('input[name="qty"]')[0].value = 0;
        }
        //var step = parseFloat($(this).parent().find('input[name="step"]').val());
        let step = parseFloat($(this).parent().data('step'));
        var oldVal = parseFloat($(this).parent().parent().find('input[name="qty"]')[0].value);
        var newVal = oldVal + step;

        //console.log(oldVal);
        console.log($(this).parent().parent().find('input[name="qty"]')[0]);
        console.log(step);
        $(this).parent().parent().find('input[name="qty"]')[0].value = newVal;
    });

    $('.dec-num').on('click', function(e){
        e.preventDefault();
        //console.log($(this).parent().find('input[type="number"]').val().length == 0);
        let val = $(this).parent().parent().find('input[name="qty"]')[0].value;
        if(val.length == 0 || val == 0)
        {
            $(this).parent().parent().find('input[name="qty"]')[0].value = 0;
            return;
        }
        //var step = parseFloat($(this).parent().find('input[name="step"]').val());
        let step = parseFloat($(this).parent().data('step'));
        var oldVal = parseFloat($(this).parent().parent().find('input[name="qty"]')[0].value);
        var newVal = oldVal - step;

        //console.log(oldVal);
        console.log($(this).parent().parent().find('input[name="qty"]')[0]);
        console.log(step);
        $(this).parent().parent().find('input[name="qty"]')[0].value = newVal;
    });

    $('.delete_btn').on('click', function(e){
        e.preventDefault();
        $(this).parent().parent().remove();
        $.ajax({
            url: $(this).attr('href'),
        });
    });

    $(".addToCartForm").on('submit', function (e) {
        // global , local
        e.preventDefault();
        let _that = $(this);
        let order_price_ele = $('#order_price');
        let old_val = $(this).data('total');
        $.ajax({
            url: $(this).attr('action'),
            method: "POST",
            data: $(this).serialize(),
            success: function (res) {
                _that.trigger("reset");
                //console.log(res);
                if (res.isNew == 0){
                    $("#cart-list .cart-empty").hide();
                    let qty = parseInt($("#cart_item_qty").text()); ++qty;
                    $("#cart_item_qty").text(qty);
                    $("#cart-list").append(`
                            <div class="row px-2 d-flex align-items-center justify-content-between data_${res.id}" name = "data_${res.id}" id = "data_${res.id}">
                                <div class="col-3">
                                    <img class="img-fluid" src="${res.photo}" alt="">
                                </div>
                                <div class="col-7">
                                    <p style="line-height: 20px;font-size: 15px" class="mb-0">
                                        <b>${res.name}</b> <br>
                                        <span id="item_qty_${res.id}">${res.qty}</span>x${res.item_price}EGP
                                    </p>
                                </div>
                                <div class="col-2">
                                    <a class="cart_delete_btn btn btn-sm btn-danger mdi mdi-trash-can" 
                                href = "/dash/remove/${res.id}"></a>
                                </div>
                            </div>
                            `);
                } else {

                    $("#item_qty_" + res.id).html(res.qty);
                }
                //updating the table column
                console.log(res.id);
                $('#item_' + res.id + '_price').text('$' + res.total);
                let new_val = res.total;
                order_price_ele.text(parseFloat(order_price_ele.text()) - old_val + new_val);
                
            },
            error: function (e) {
                swal.fire("An error Happened", "", "error"),
                    console.log(e)
            }
        });
    });


});
