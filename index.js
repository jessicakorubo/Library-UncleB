const table_btn = document.querySelectorAll('button.table-btn');

var my_btn = [].slice.call(table_btn);



console.log('this is', my_btn, 'inactive');
my_btn.forEach(btn => {

    if (btn.classList.contains('pending')) {
        btn.innerHTML = 'PENDING...'
    }
    else if (btn.classList.contains('returned')) {
        btn.innerHTML = 'RETURNED';
    }

});



// FOR THE POPUPS THAT HAVE TO BE IN AN ARRAY

const delArray = document.querySelectorAll('button.delete_array')
const pops = document.querySelectorAll('.popup_array');
const popArray = [].slice.call(pops);



delArray.forEach(del => {
    del.addEventListener('click', (e) => {

        const popup2 = e.target.nextElementSibling;

        console.log(e.target.nextElementSibling);
        for (i = 0; i < popArray.length; i++) {

            if (popArray[i].classList.contains('active')) {
                popArray[i].classList.remove('active');
            }

            // console.log(popArray[i], ' element in the array');
            // e.target.nextElementSibling.classList.add('active');
        }
        // e.target.nextElementSibling.classList.add('active');


        
        popup2.classList.add('active');
        e.stopPropagation();

        document.addEventListener('click', (e) => {
            // var eventAdded = true;
            popup2.classList.remove('active');
            if (e.target == del) {
                popup2.classList.add('active');
            }
        })
    })
})

const delBtn = document.querySelector('button.delete_single');
var popups = document.querySelector('.single_popup');

delBtn.addEventListener('click', (e) => {

    // for (i = 0; i < popArray.length; i++) {
    //     // console.log(i, 'element in the array');
    //     if (popArray[i].classList.contains('active')) {
    //         popArray[i].classList.remove('active');
    //         e.target.classList.add('active');
    //     }
    // }

    var tar = e.target.nextElementSibling;
    console.log(tar);
    tar.classList.add('active');
    e.stopPropagation();



    // console.log(this, 'event listener')

    document.addEventListener('click', (e) => {
        // var eventAdded = true;
        tar.classList.remove('active');
        if (e.target == delBtn) {
            tar.classList.add('active');
        }
    })

})


var buttonDiv = document.querySelectorAll('.button-div');


// GIVING MY DATE INPUT DEFAULT VALUE THE CURRENT DATE



// console.log(document.querySelector('#issued_date input'));

// function modifyDate (inputContainer) {

//     var today = new Date().toISOString().split('T')[0];
//     console.log(today);
//     inputContainer.value = today;

// }

// if (issued_date = document.querySelector('#date_issued input')){
//     modifyDate(issued_date);
// }

// if (register_date = document.getElementById('register-date')){
//     modifyDate(register_date);
// }

// const due_date = document.querySelector('#due_date input');
// due_date.value


// SINGLE BOOK PAGE - TO MAKE ISSUE BUTTON DISABLED IF BOOK IS ISSUED

var mystatus = document.getElementsByClassName('status');
console.log(mystatus);
var copy_status = Array.from(mystatus);
console.log(copy_status);
copy_status.forEach(stat => {
    var stat_con = stat.innerText;
    console.log(stat_con);
    if (stat_con == "Issued") {
        var action = stat.nextElementSibling;
        var button = action.querySelector('#issue-btn');
        console.log(button);
        button.disabled = true;
        button.classList.add('disabled');
    }


});


// ISSUED BOOKS TABLE = TO OPEN THE POP UP FOR THE RETURN BUTTON

// const return_button  = document.querySelectorAll('.return-button');
// const return_pop = document.querySelectorAll('.popup-return');
// const return_array = [].slice.call(return_pop);




// TURING BASKETBALL TEST SOLUTION

var arrOps = ["5", "2", "D", "+", "3"];
// 5, 10, 50, 4 
var res;

function calculate() {
    for (var i = 0; i <= arrOps.length; i++) {
        var ops = arrOps[i];
        var j = arrOps.indexOf(ops) - 1;
        var opsPrev = Number(arrOps[j]);
        var j2 = arrOps.indexOf(ops) - 2;
        var opsPrev2 = Number(arrOps[j2]);
        var j3 = arrOps.indexOf(ops) - 3;
        var opsPrev3 = Number(arrOps[j3]);
        calculateOps();
    }
    function calculateOps() {
        switch (ops) {
            case "D":
                res = opsPrev * 2;
                // list += " "+res;
                // list.push(res);
                arrOps[i] = res;
                break;

            case "+":
               
                res = opsPrev + opsPrev2;
                arrOps[i] = res;
                break;

            case "C":
                // arrOps[j] = '';
                // arrOps[i] = res;
                break;

            default:
                // list += " "+ops;
                // list.push(ops);
                break;
        }
    }
    return arrOps;
    // function returnResult () {
    //     arrOps.reduce(cur, sum )
    // }
}
 
calculate();



check the array for the current value, then create a variable that you 