// Get elements once
const overlay = document.getElementById('filterOverlay');
const filterPopup = document.getElementById('filterPopup'); // Give your popup an ID

// Function to close the popup
function closeFilter() {
  overlay.classList.add('d-none');
  filterPopup.classList.add('d-none');
}

// Function to open the popup
function openFilter() {
  overlay.classList.remove('d-none');
  filterPopup.classList.remove('d-none');
}

// Optional: clicking the overlay closes the popup
overlay.addEventListener('click', closeFilter);


$("#results").load("search-products?page=1");
let typingTimer;
const typingDelay = 300; 
$(document).on("keyup","#q",function(){
    clearTimeout(typingTimer);
    const x = $('#q').val();
    typingTimer = setTimeout(() => {
      getData(x);
    }, typingDelay);
  });

  $(document).on("change","#category",function(){
    const x = $('#q').val();
    const category = $("#category").val();
    getData(x, category);
    });

  
  $(document).on("click","#update",function(){
  const x = $('#q').val();
  const category = $("#category").val();
  const minprice = $("#min_price").val();
  const maxprice = $("#max_price").val();

  getData(x, category, minprice, maxprice);
  });


  $(document).on("change","#sort",function(){
    const x = $('#q').val();
    const category = $("#category").val();
    const minprice = $("#min_price").val();
    const maxprice = $("#max_price").val();
    const sort = $("#sort").val();
    
    getData(x, category, minprice, maxprice, sort);
    });

    $(document).on("click",".btn-pagination",function(){
        const x = $('#q').val();
        const category = $("#category").val();
        const minprice = $("#min_price").val();
        const maxprice = $("#max_price").val();
        const sort = $("#sort").val();
        const page = $(this).data("page");
        
        getData(x, category, minprice, maxprice, sort, page);
        });


function getData(x = "", category = "", minprice = "", maxprice = "", sort = "" ,page = ""){
    $(".spinner-border").show();
    $.ajax({
          url:"search-products",
          method:"POST",
          data:{
            q:x,
            category:category,
            minprice:minprice,
            maxprice:maxprice,
            sort:sort,
            page:page
          },
          success:function(data){
                $(".spinner-border").hide();
                $("#results").html(data.trim() ? data : "No product found");
          }
    });
}
