<!-- JS FOR: SHOW/HIDE Expired Menu Section Add UserLogins -->
<script>
function toggleAddExpDate() {
    var statusSelect = document.getElementById("addUserLoginStatus");
    var expDateContainer = document.getElementById("addExpDateContainer");
    var expDateInput = document.getElementById("addUserLoginExpDate");

    if (statusSelect.value === "Limited") {
        expDateInput.disabled = false;
        // Set the current date as the value
        expDateInput.value = new Date().toISOString().split("T")[0];
    } else {
        expDateInput.disabled = true;
        // Clear the value
        expDateInput.value = "";
    }
}
</script>








<!-- CUST JS: SCROOL POSITION REMBR -->
<script>
window.onbeforeunload = function() { // save scroll position
    localStorage.setItem('scrollPosition', window.pageYOffset);
}
window.onload = function() { // load scroll position
    var scrollPosition = localStorage.getItem('scrollPosition');
    if (scrollPosition !== null) {
        window.scrollTo(0, scrollPosition);
    }
}
</script>




<!-- MAXIMIZE + FULLSCREEN JS -->
<script>
var clickedbyuser = true;

function fullscreenFunct() {

    var media_card = document.getElementById("media_wrapper");
    if (clickedbyuser) {
        media_card.classList.add(
            "full_screen"); // add F11 trigger 
        document.documentElement.requestFullscreen();
        // update button icon 
        document.getElementById("areaChartDropdownExample0").innerHTML =
            '<i class="fas fa-compress-alt text-gray-500"></i>';
    } else {
        media_card.classList.remove("full_screen"); // remove F11 trigger 
        document.exitFullscreen(); // update button icon 
        document.getElementById("areaChartDropdownExample0").innerHTML =
            '<i class="fas fa-expand-arrows-alt text-gray-500"></i>';
    }
    clickedbyuser = !clickedbyuser;
}
</script>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"></script> -->





<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous">
</script>
<!-- JavaScript file -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/js/bootstrap.bundle.min.js"></script> -->


<script type="text/javascript" src="dist/js/scripts.js"></script>
<!-- Note: Untuk toast wajib ada; jquery v3.3.1, popper.min.js v1.14.3, bootstrap.bundle.min.js v4.5.3, toast.js -->
<script type="text/javascript" src="dist/js/toasts.js"></script>


<!-- <script type="text/javascript" src="dist/js/autocomplete.jsv10.2.7/autoComplete.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/autoComplete.min.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.17.1/components/prism-core.min.js"
    crossorigin="anonymous">
</script>
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.17.1/plugins/autoloader/prism-autoloader.min.js"
    crossorigin="anonymous"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"
    crossorigin="anonymous"></script>
<!-- <script type="text/javascript" src="dist/assets/demo/chart-area-demo.js"></script> -->
<!-- <script type="text/javascript" src="dist/assets/demo/chart-bar-demo.js"></script> -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous">
</script>
<script type="text/javascript" src="dist/js/datatables/datatables-simple-demo.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous">
</script>

<script type="text/javascript" src="dist/js/litepicker.js"></script>









<!-- JS FOR: USERPAGE(TOAST JS) -->
<script type="text/javascript">
$("#toastBasicTrigger").on("click", function(e) {
    e.preventDefault();
    $("#toastBasic .toast-body").text("TESTING TOAST!");
    $("#toastBasic").toast({
        autohide: false
    });
    $("#toastBasic").toast("show");

    setTimeout(function() {
        $("#toastBasic").toast("hide");
        <?php $toastMsg = ""; ?>
    }, 8000);
});
</script>


<!-- JS FOR: LOGIN & USERPAGE(TOAST JS) -->
<?php
if (isset($_SESSION['toastMessages'])) : ?>
<script>
window.onload = function() {
    <?php if (isset($_SESSION['toastMessages'][0])) :
                if (($_SESSION['toastMessages'][0] == 'code_green')) : ?>
    $('#toastBasic').removeClass('code_normal');
    $('#toastBasic').addClass('code_green');
    <?php elseif (($_SESSION['toastMessages'][0] == 'code_red')) : ?>
    $('#toastBasic').removeClass('code_normal');
    $('#toastBasic').addClass('code_red');
    <?php elseif (($_SESSION['toastMessages'][0] == 'code_yellow')) : ?>
    $('#toastBasic').removeClass('code_normal');
    $('#toastBasic').addClass('code_yellow');
    <?php elseif (($_SESSION['toastMessages'][0] == 'code_gray')) : ?>
    $('#toastBasic').removeClass('code_normal');
    $('#toastBasic').addClass('code_gray');
    <?php
                endif;
            endif; ?>


    $("#toastBasic .toast-body").text("<?= $_SESSION['toastMessages'][1] ?>");
    $("#toastBasic").toast({
        autohide: false
    });
    $("#toastBasic").toast("show");

    setTimeout(function() {
        $("#toastBasic").toast("hide");
        <?php if (isset($_SESSION['toastMessages'][0])) :
                    if (($_SESSION['toastMessages'][0] == 'code_green')) : ?>
        $('#toastBasic').removeClass('code_green');
        $('#toastBasic').addClass('code_normal');
        <?php elseif (($_SESSION['toastMessages'][0] == 'code_red')) : ?>
        $('#toastBasic').removeClass('code_red');
        $('#toastBasic').addClass('code_normal');
        <?php elseif (($_SESSION['toastMessages'][0] == 'code_yellow')) : ?>
        $('#toastBasic').removeClass('code_yellow');
        $('#toastBasic').addClass('code_normal');
        <?php elseif (($_SESSION['toastMessages'][0] == 'code_gray')) : ?>
        $('#toastBasic').removeClass('code_gray');
        $('#toastBasic').addClass('code_normal');
        <?php
                    endif;
                endif; ?>

        <?php unset($_SESSION['toastMessages']); ?>
    }, 8000);
}
</script>
<?php endif; ?>




<!-- JS FOR: USERPAGE(CONFIRMATION MODAL JS) -->
<!-- JavaScript code -->
<script>
// Define a variable to store the countdown interval
var countdownInterval;

function showConfirmationModal(callback) {
    $("#confirmDelUserLogin").modal('show');

    $("#modal-continue-btn").off().on("click", function() {
        callback(true);
        // $("#confirmDelUserLogin").modal('hide');
    });


    $("#modal-close-btn").off().on("click", function() {
        callback(false);
        // Clear the countdown interval when the cancel button is clicked
        clearInterval(countdownInterval);
        document.getElementById('countdown').innerHTML = '';
        $("#confirmDelUserLogin").modal('hide');
        $("#modal-continue-btn").text("Continue Delete");
    });


    $("#modal-cancel-btn").off().on("click", function() {
        callback(false);

        // Clear the countdown interval when the cancel button is clicked
        clearInterval(countdownInterval);
        document.getElementById('countdown').innerHTML = '';
        $("#modal-continue-btn").text("Continue Delete");
        // $("#confirmDelUserLogin").modal('hide');
    });
}

function deleteFunction(del_url) {
    // Code to perform the delete operation

    $("#modal-continue-btn").text("Force Delete!");
    // alert('Deleting...');
    var duration = 10; // Change this value to your desired duration in seconds

    function updateCountdown() {
        // Check if the countdown has reached zero

        if (duration <= 0) {
            // Countdown has foreced to end
            clearInterval(countdownInterval);
            document.getElementById('countdown').innerHTML = 'Ready to go!';
            window.location.href = del_url + '&js=del';
            return;
        }
        $("#modal-continue-btn").on("click", function() {
            // $("#confirmDelUserLogin").modal('hide');
            if ($("#modal-continue-btn").text() === "Force Delete!") {
                document.getElementById('countdown').innerHTML = '';
                $("#modal-continue-btn").text("Continue Delete");
                window.location.href = del_url + '&js=del';
                clearInterval(countdownInterval);
            }
        });


        // Update the countdown text in the HTML
        document.getElementById('countdown').innerHTML = duration + ' seconds';
        // Decrease the duration by 1 second
        duration--;
    }
    // Update the countdown immediately
    updateCountdown();

    // Update the countdown every second and store the interval in the countdownInterval variable
    countdownInterval = setInterval(updateCountdown, 1000);
}
</script>










<!-- JS FOR: USERPAGE(TOAST JS) -->
<script type="text/javascript">
$("#toastBasicTrigger").on("click", function(e) {
    e.preventDefault();
    $("#toastBasic .toast-body").text("TESTING TOAST!");
    $("#toastBasic").toast({
        autohide: false
    });
    $("#toastBasic").toast("show");

    setTimeout(function() {
        $("#toastBasic").toast("hide");
        <?php $toastMsg = ""; ?>
    }, 8000);
});
</script>





<!-- JS FOR: SEARCHABLE DROPDOWN -->
<!-- <script type="text/javascript" src="dist/js/choices.js.9.0.1/choices.min.js"></script> -->

<!-- Include Choices JavaScript (latest) -->
<!-- <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/choices.js@10.0.0"></script>


<script>
var classNames = [
    "choices-single-1", "choices-single-2", "choices-single-3",
    "choices-single-4", "choices-single-5", "choices-single-6"
];

classNames.forEach(function(className) {
    var elements = document.getElementsByClassName(className);

    if (elements.length > 0) {
        new Choices(elements[0], {
            allowHTML: true,
            searchEnabled: true
        });
    }
});
</script>







<!-- addEmployeeDomAddr -->
<!-- 
<script>
$(document).ready(function() {
    $('#addEmployeeDomAddr').select2({
        placeholder: 'Search for an option',
        minimumInputLength: 2,

        ajax: {
            url: 'fungsi/id_address.php',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                // Process the data
                return {
                    results: data.map(function(item, index) {
                        return {
                            id: index,
                            text: item
                        };
                    })
                };
            },
            success: function(response) {
                console.log(response); // Log the response data to the console
            },
            cache: true
        }

    });
});
</script> -->









<!-- <script>
function toggleExpDate() {
    var statusSelect = document.getElementById("addUserLoginStatus");
    var expDateInput = document.getElementById("userLoginExpDate");

    if (statusSelect.value === "Limited") {
        expDateInput.disabled = false;
        expDateInput.value = getCurrentDateFormatted();
    } else {
        expDateInput.disabled = true;
        expDateInput.value = "";
    }
}

function getCurrentDateFormatted() {
    var currentDate = new Date();
    var formattedDate = currentDate.toLocaleDateString("en-US", {
        month: "2-digit",
        day: "2-digit",
        year: "numeric"
    });
    return formattedDate;
}

// Call the function when the page loads
toggleExpDate();
</script>
 -->












<!-- 
<script type="text/javascript">
$('.view_data').click(function() {
    var idtoedit = $(this).attr('id');
    $.ajax({
        url: 'f_wrapper.php',
        method: 'post',
        data: {
            id: idtoedit,
            action: "EDIT",
            which: "DIVISION"
        },
        success: function(data) {
            $('#datatoedit').html(data)
            $('#editDivisionModal').modal('show');
        }
    })

})
</script> -->






<!-- SELECT2.JS - V1 (WORKS RINGAN > FOR SELECT) -->
<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    var selectElement = document.getElementById('addEmployeeDomAddr');
    var jsonData = []; // Store the JSON data

    // Function to fetch the JSON data from the API
    function fetchJSONData() {
        var url =
            "fungsi/id_address.php?alamat_dom=";
        // "https://raw.githubusercontent.com/yusufsyaifudin/wilayah-indonesia/master/data/list_of_area/indonesia-region.min.json";

        fetch(url)
            .then(response => response.json())
            .then(data => {
                // Store the data
                jsonData = data;

                // Populate the select element with options using Select2
                $(selectElement).select2({
                    data: jsonData.map(item => ({
                        id: item.id,
                        text: item.name
                    }))
                });
            })
            .catch(error => {
                // Handle any errors here
                console.log(error);
            });
    }

    // Load the JSON data from the API
    fetchJSONData();
});
</script> -->







<!-- CHOICE.JS - V2 (WORKS RINGAN > FOR SELECT) -->
<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    var selectElement = document.getElementById('addEmployeeDomAddr');
    var jsonData = []; // Store the JSON data
    var chunkSize = 50; // Number of items to load per chunk
    var loadedChunks = 0; // Number of already loaded chunks

    // Function to fetch the JSON data
    function fetchJSONData() {
        var url =
            "fungsi/id_address.php?alamat_dom=";

        fetch(url)
            .then(response => response.json())
            .then(data => {
                // Split the data into chunks
                while (data.length > 0) {
                    jsonData.push(data.splice(0, chunkSize));
                }

                // Load the initial chunk
                loadChunk();
            })
            .catch(error => {
                // Handle any errors here
                console.log(error);
            });
    }

    // Function to load a chunk of data
    function loadChunk() {
        if (loadedChunks < jsonData.length) {
            var chunk = jsonData[loadedChunks];

            // Update the select element with the data from the current chunk
            chunk.forEach(function(item) {
                var option = document.createElement('option');
                option.value = item.id;
                option.text = item.name;
                selectElement.appendChild(option);
            });

            loadedChunks++;
        }
    }

    // Load the JSON data
    fetchJSONData();

    // Load additional chunks when reaching the bottom
    window.addEventListener('scroll', function() {
        var scrollPosition = window.innerHeight + window.pageYOffset;
        var documentHeight = document.documentElement.offsetHeight;

        // Adjust the threshold as per your requirements
        if (scrollPosition >= documentHeight - 200) {
            loadChunk();
        }
    });
});
</script> -->






<!--  CHOICE.JS - V1 (WORKS BERAT > FOR SELECT) -->
<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    var selectElement = document.getElementById('addEmployeeDomAddr');

    fetch(
            'https://raw.githubusercontent.com/yusufsyaifudin/wilayah-indonesia/master/data/list_of_area/indonesia-region.min.json')
        // fetch('fungsi/id_address.php')
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            data.forEach(function(province) {
                var option = document.createElement('option');
                option.value = province.id;
                option.text = province.name;
                selectElement.appendChild(option);

                if (province.regencies) {
                    province.regencies.forEach(function(regency) {
                        var option = document.createElement('option');
                        option.value = regency.id;
                        option.text = regency.name;
                        selectElement.appendChild(option);

                        if (regency.districts) {
                            regency.districts.forEach(function(district) {
                                var option = document.createElement('option');
                                option.value = district.id;
                                option.text = district.name;
                                selectElement.appendChild(option);

                                if (district.villages) {
                                    district.villages.forEach(function(village) {
                                        var option = document.createElement(
                                            'option');
                                        option.value = village.id;
                                        option.text = village.name;
                                        selectElement.appendChild(option);
                                    });
                                }
                            });
                        }
                    });
                }
            });
        });
});
</script> -->



<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('addEmployeeDomAddr');

    // Initialize autoComplete.js
    new autoComplete({
        selector: '#addEmployeeDomAddr',
        minChars: 2,
        // cache: true,
        debounce: 500,
        delay: 250,
        source: async function(term, response) {
            // Fetch data from the API endpoint
            var url = 'fungsi/id_address.php?alamat_dom=' + term;
            var res = await fetch(url);
            var data = await res.json();

            // Provide the suggestions to autoComplete.js
            response(data);
        },
        renderItem: function(item, search) {
            // Customize the appearance of each suggestion item
            search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
            var re = new RegExp('(' + search.split(' ').join('|') + ')', 'gi');
            var highlightedValue = item.value.replace(re, '<mark>$1</mark>');
            return '<div class="autocomplete-suggestion" data-val="' + item.value + '">' +
                highlightedValue + '</div>';
        },
        onSelect: function(event, term, item) {
            // Handle the selection of an autocomplete suggestion
            console.log('Selected:', term);
        }
    });
});
</script> -->