    $(document).ready(function(){
        onlyOneSelectedCheckBox();
        setNumberOnly();
        getDataPrice(function(data){
            // calculate total price summary by input qty and selected checkbox price
            function calculateSum(){
                var prAgen = Number(data.item_price_agen);
                var prPenyalur = Number(data.item_price_penyalur);
                var prEceran = Number(data.item_price_eceran);
                var sumTotal = 0;
                var qty = $("#qty").val();
                // statement get total by selected checkbox
                if($('#agenCbx').is(':checked') == true){
                    sumTotal += (prAgen*qty);
                }else if($('#penyalurCbx').is(':checked') == true){
                    sumTotal += (prPenyalur*qty);
                }else if($('#eceranCbx').is(':checked') == true){
                    sumTotal += (prEceran*qty);
                }
                // var rp = "Rp. ";
                $("#totalPrice").val("Rp. "+ sumTotal);
            }

            // auto change total by selected qty method
            $(".qtyInputNumber").keyup(function(){
                calculateSum();
            });
            // auto change total by selected agen price checkbox method
            $('input[name="chkAgen"]').change(function(){
                calculateSum();
            });
            // auto change total by selected penyalur price checkbox method
            $('input[name="chkPenyalur"]').change(function(){
                calculateSum();
            });
            // auto change total by selected eceran price checkbox method
            $('input[name="chkEceran"]').change(function(){
                calculateSum();
            });
            // auto change select option item name
            $('#itemNameSelected').attr('change', function(){
                var data = $(this).val();
                calculateSum(data);
            });
        })

        addingQtyItemMasterOnUpdate();
}); // document ready function

    function addingQtyItemMasterOnUpdate(){
        $('#addQty').on('change', function(){
            var getTotalQty = parseInt($('#qtyTotalUpdate').val()) + parseInt($('#addQty').val());
            $('#afterAddQtyTotal').val(getTotalQty);
        });
    }

    function getDataPrice(callback){
        $(document).on('change', '.nameItem', function(){
            // get id by item Name
            var id = $(this).val();
            $.ajax({
                type : 'get',
                url : '/findPrice',
                data : { 'item_id' : id},
                dataType : 'json', // return data will be json
                success : function(data){
                    var rp = "Rp. ";
                    var qty = "in stock: ";
                    $('#priceAgen').val(rp + data.item_price_agen);
                    $('#pricePenyalur').val(rp + data.item_price_penyalur);
                    $('#priceEceran').val(rp + data.item_price_eceran);
                    $('#qtyReady').val(qty + data.item_quantity);

                    callback(data);
                }
            });
        });
    }

    function setNumberOnly(){
        (function($) {
            $.fn.inputFilter = function(inputFilter) {
              return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
                if (inputFilter(this.value)) {
                  this.oldValue = this.value;
                  this.oldSelectionStart = this.selectionStart;
                  this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                  this.value = this.oldValue;
                  this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                  this.value = "";
                }
              });
            };
          }(jQuery));


          // Install input filters.
        $(".qtyInputNumber").inputFilter(function(value) {
            return /^-?\d*$/.test(value); });
            // console.log(a);

        $(".numOnly").inputFilter(function(value) {
            return /^-?\d*$/.test(value); });
    }

    function onlyOneSelectedCheckBox(){
        $('input[type="checkbox"]').on('change', function() {
            $('input[type="checkbox"]').not(this).prop('checked', false);
         });
    }


