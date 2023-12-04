function updatePageContents(searchTearms){
    if (!sessionStorage.getItem("currentPage")){
        currentPage = sessionStorage.setItem("currentPage", 1);
    } else {
        currentPage = sessionStorage.getItem("currentPage");
    }
    getProducts(currentPage, searchTearms);
}

function updatePageNumber(newPageNumber){
    numberOfPages = sessionStorage.getItem("numberOfPages");
    if (newPageNumber > numberOfPages){
        newPageNumber = numberOfPages;
    } else if (newPageNumber < 1){
        newPageNumber = 1;
    }
    sessionStorage.setItem("currentPage", newPageNumber);
    updatePageContents(null);
}

function prevPage(){
    currentPage = parseInt(sessionStorage.getItem("currentPage"))-1;
    updatePageNumber(currentPage);
}
function nextPage(){
    currentPage = parseInt(sessionStorage.getItem("currentPage"))+1;
    updatePageNumber(currentPage);
}

function getProducts(pageNumber, searchTearms){
    $.ajax({
        url:"includes/productPageNav.php",    //the page containing php script
        type: "post",    //request type,
        dataType: 'json',
        data: {maxResultsPerPage: 8, pageNumber: pageNumber, searchTearms: searchTearms},
        success:function(result){
            console.log(result.products);
            displayProducts(result.products);
            updatePagination(currentPage, result.numberOfPages);
            sessionStorage.setItem("numberOfPages", result.numberOfPages);
        }
    });
    return null;
}

function displayProducts(products){
    productContainer = document.getElementById('products'); // Get container to put data into
    productContainer.innerHTML = ""; // Clear container to remove old products
    for (i in products){
        console.log(products[i]);
        // Construct card elements
        div =  card = document.createElement("div");
        card.setAttribute('class','col mt-2 px-1');
        card = document.createElement("div");
        card.setAttribute('class','card bg-dark text-white');
        div.appendChild(card);
        imageContainer = document.createElement("div");
        image = document.createElement("img");
        image.setAttribute('class','card-img-top');
        if (products[i].image){
            image.src = products[i].image;
        } else {
            image.src = "images/product placeholders/product placeholder.jpg";
            image.alt = "no image for this product exists";
        }
        imageContainer.appendChild(image);
        imageContainer.setAttribute("class", "card");
        stock = 0; // hardcoded for testing       
        
        card.appendChild(imageContainer);
        cardBody = document.createElement("div");
        cardBody.setAttribute('class','card-body rounded');
        card.appendChild(cardBody); // Nests card within the mainDiv
        // Top row elements (price)
        topRow = document.createElement("div");
        topRow.setAttribute('class','row');
        cardBody.appendChild(topRow);
        topLeftCol = document.createElement("div");
        topLeftCol.setAttribute('class','col-8');
        topRow.appendChild(topLeftCol);
        productTitle = document.createElement("h5");
        productTitle.setAttribute('class','card-title');
        productTitle.innerHTML = products[i].ProductName;
        topLeftCol.appendChild(productTitle);
        topRightCol = document.createElement("div");
        topRightCol.setAttribute('class','col-4');
        topRow.appendChild(topRightCol);
        productCost = document.createElement("h5");
        productCost.setAttribute('class','card-title');
        topRightCol.appendChild(productCost);
        productCost.innerHTML = "£"+products[i].SellingPrice;
        midRow = document.createElement("div");
        midRow.setAttribute('class','row mb-1');
        cardBody.appendChild(midRow);
        productDescription = document.createElement("p");
        productDescription.setAttribute('class','card-text crop-text-2');
        productDescription.innerHTML = products[i].Description;
        midRow.appendChild(productDescription);
        bottomRow = document.createElement("div");
        bottomRow.setAttribute('class','row');
        cardBody.appendChild(bottomRow);
        buttonGroup = document.createElement("div");
        buttonGroup.setAttribute('class','btn-group');
        buttonGroup.setAttribute('data-toggle','buttons');
        bottomRow.appendChild(buttonGroup);
        leftButton = document.createElement("a");
        leftButton.setAttribute('class','btn btn-outline-primary col-6');
        leftButton.innerHTML = "Generate report"
        buttonGroup.appendChild(leftButton);
        RightButton = document.createElement("a");
        RightButton.setAttribute('class','btn btn-outline-warning col-6');
        RightButton.innerHTML = "Mark as in-stock"
        buttonGroup.appendChild(RightButton);
        productContainer.appendChild(div)
        if (stock == 0){ // should be something like: products.Quantity
            image.setAttribute("style", "filter: blur(1px) brightness(60%);") // wanted to use a class with these styles and set that but it wasn't working :p
            imageOverlay = document.createElement("div");
            imageOverlay.setAttribute("class", "card-img-overlay d-flex align-items-center justify-content-center");
            outOfStockMsg = document.createElement("h4");
            outOfStockMsg.innerHTML = "Out of stock";
            outOfStockMsg.setAttribute("class", "text-center")
            imageOverlay.appendChild(outOfStockMsg);
            imageContainer.appendChild(imageOverlay);
            leftButton.setAttribute("class", "btn btn-outline-primary col-6 disabled");
            RightButton.setAttribute("class", "btn btn-outline-warning col-6 disabled");
        } 
    }
}

function updatePagination(currentPage, numberOfPages){
    prevFullBtn = document.getElementById('prevFullBtn'); 
    prevSmallBtn = document.getElementById('prevSmallBtn'); 
    nextFullBtn = document.getElementById('nextFullBtn'); 
    nextSmallBtn = document.getElementById('nextSmallBtn');
    formInput = document.getElementById('formInput'); 
    pageCount = document.getElementById('pageCount');
    
    if (currentPage <= 1){
        prevFullBtn.setAttribute('class','btn btn-outline-success d-none d-sm-block disabled'); 
        prevSmallBtn.setAttribute('class','btn btn-outline-success d-block d-sm-none disabled');
    } else {
        prevFullBtn.setAttribute('class','btn btn-outline-success d-none d-sm-block'); 
        prevSmallBtn.setAttribute('class','btn btn-outline-success d-block d-sm-none');
    }
    
    if (currentPage >= numberOfPages){
        nextFullBtn.setAttribute('class','btn btn-outline-success d-none d-sm-block disabled'); 
        nextSmallBtn.setAttribute('class','btn btn-outline-success d-block d-sm-none disabled');
    } else {
        nextFullBtn.setAttribute('class','btn btn-outline-success d-none d-sm-block'); 
        nextSmallBtn.setAttribute('class','btn btn-outline-success d-block d-sm-none');
    }
    formInput.setAttribute('value', currentPage)
    pageCount.innerHTML = numberOfPages;
}
function paginationForm() {
    formInput = document.getElementById('formInput').value;
    updatePageNumber(formInput);
}