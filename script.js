'use strict'
$(function () {
    $('#update').on('submit', function (evnt) { 
        evnt.preventDefault();
        let radioValue = $("input[name='propertyType']:checked").val();
        let occupied = $("input[name='occupied']:checked").val();
        let rooms = ($('#rooms').val());
        let propertyCost = 0;
        let occupiedCost= 0;
        let totalCost= 0;

        if (radioValue === 'Residential') {
            propertyCost = 10;
        } else if (radioValue === 'Commercial') {
            propertyCost = 20;
        } else if ( radioValue === 'MultiUnit') {
            propertyCost = 30;
        } 
        
        if (occupied === 'Yes') {
            occupiedCost = 20;
        } else { 
            occupiedCost == 0 
        }
        totalCost = (propertyCost * rooms) + occupiedCost;
        //console.log(totalCost);
        //print out values
        $('#propertyTypeChoice').text(radioValue);
        $('#occupiedChoice').text(occupied);
        $('#roomsChoice').text(rooms);
        $('#costChoice').text('$' +totalCost);
        
      });
        
          $('#customerInfo').on('submit', function(evnt) {
            evnt.preventDefault();
            let elements = this.elements;
            for (let i = 0; i < elements.length; i++) {
              //console.log($(elements[0]).val());
            }
            let newUser = ($(elements[0]).val())
            $('#hey').text('Welcome! ' +newUser); 

            let output = $('#message');
            output.css('display','inherit');     
      });
    
    });



    
 
  
    

    












  

    // function zip() {
    //     //let output = $('#bodyStyle');
    //     let zip = $('#zip').val();
    //     let zipChoice = $('#zipChoice');
    //     zipChoice.text(zip);
    // }

  
  
 
    
      

