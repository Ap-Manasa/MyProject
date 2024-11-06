
<?php
include_once "./include/header.php";
$cities = ["Whitefield", "Koramangala", "Indiranagar", "Jayanagar", "Marathahalli", "Electronic City", "HSR Layout", "Banashankari", "Basavanagudi", "Malleshwaram", "Rajajinagar", "Frazer Town", "Yelahanka", "Hebbal", "BTM Layout", "Ulsoor", "Sarjapur Road", "Bellandur", "Kalyan Nagar", "JP Nagar", "KR Puram", "Hennur", "Banaswadi", "Nagawara", "Majestic", "MG Road", "Richmond Town", "Shantinagar", "Cox Town", "Basaveshwaranagar", "Vijayanagar", "Nagarbhavi", "Uttarahalli", "RT Nagar", "Kadugodi", "Domlur", "Kengeri", "Banerghatta Road", "HBR Layout", "Kammanahalli", "Peenya", "Mahadevapura", "Yeshwanthpur", "Sadashivanagar", "Chandra Layout", "JP Nagar", "Mysore Road", "Kumaraswamy Layout", "Varthur", "Nagasandra", "Kanakapura Road", "Vidyaranyapura", "Devanahalli", "Anekal", "Horamavu", "Jakkur", "Lingarajapuram", "Thanisandra", "Vignana Nagar", "Kogilu", "Bommanahalli", "Jeevan Bima Nagar", "Hoysala Nagar", "Anjanapura", "Jalahalli", "Sunkadakatte", "Hegde Nagar", "Attibele", "Kadubeesanahalli", "Singasandra", "Begur", "Byrasandra", "Vasanth Nagar", "Adugodi", "Puttenahalli", "Vittal Mallya Road", "Magadi Road", "Manjunath Nagar", "Vidya Nagar", "Doddanekundi", "Doddaballapur", "Cox Town", "Billekahalli", "Avalahalli", "Kaikondrahalli", "Haralur Road", "Arekere", "Chikbanavara", "Doddakammanahalli", "Medahalli", "Sahakara Nagar", "Srirampura", "Hesaraghatta", "Hunasamaranahalli", "Singapura Layout", "Garudacharpalya", "RMV Extension", "Vidyaranyapura", "Kamala Nagar", "Bommasandra"];
?>


<div class="container" style="margin-top:20px;">
    <div class="jumbotron text-center">
        <h1 class="display-4">Welcome to Easy Fix!</h1>
        <p class="lead">Connecting you with trusted service providers in Bangalore.</p>
        <hr class="my-4">
        <p>Whether you need an electrician, plumber, or carpenter etc.., we've got you covered.</p>
        <a class="btn btn-primary btn-lg" href="register.php" role="button">Register as a Service Provider</a>
    </div>

    <h2 class="text-center" style="margin-top: 20px">Find Your Service Provider</h2>
    <hr>

    <div class="row" style="margin-top:20px; margin-bottom: 60px;">
        <div class="col-md-6 offset-md-3">
            <div class="form-group">
                <label for="city">City</label>
                <select class="form-control" name="city" id="city">
                    <option value="none">-- Select City --</option>
                    <?php foreach ($cities as $city) : ?>
                    <option value="<?= $city ?>"><?= $city ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group text-center">
                <label for="profession">Who's Required</label>
                <div class="profession-selection">
                    <div class="row">
                        <div class="col-3">
                            <img src="images/electrician.jpg" alt="Electrician" class="profession-img" data-profession="electrician">
                        </div>
                        <div class="col-3">
                            <img src="images/carpenter.jpg" alt="Carpenter" class="profession-img" data-profession="carpenter">
                        </div>
                        <div class="col-3">
                            <img src="images/cleane.jpg" alt="Cleaner" class="profession-img" data-profession="cleaner">
                        </div>
                        <div class="col-3">
                            <img src="images/painter.jpg" alt="Painter" class="profession-img" data-profession="painter">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <img src="images/pest.jpg" alt="Pest Control" class="profession-img" data-profession="pest">
                        </div>
                        <div class="col-3">
                            <img src="images/pet.jpg" alt="Pet Grooming" class="profession-img" data-profession="pet">
                        </div>
                        <div class="col-3">
                            <img src="images/plum.jpg" alt="Plumber" class="profession-img" data-profession="plumber">
                        </div>
                        <div class="col-3">
                            <img src="images/tutor.jpg" alt="Tutor" class="profession-img" data-profession="tutor">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="profession" id="profession" value="none">
            </div>

            <div class="form-group text-center">
                <button id="search" class="btn btn-success" type="button">Search</button>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table id="providers" class="table">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Profession</th>
                    <th>Rating</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan='6'>Select city and profession..</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="js/jquery.js"></script>

<script>
$(function () {
    console.log("Script is running.");

    $(".profession-img").click(function () {
        $(".profession-img").removeClass("selected");
        $(this).addClass("selected");
        $("#profession").val($(this).data("profession"));
    });

    $("#search").click(function() {
        var city = $("#city").val();
        var profession = $("#profession").val();

        if (city === "none" || profession === "none") {
            alert("Please select both city and profession!");
        } else {
            $.post('scripts/searchproviders.php', {
                city: city,
                profession: profession
            }, function(res) {
                var providers = JSON.parse(res);
                var tbody = "";

                if (providers.failed === true) {
                    tbody = "<tr><td colspan='6'>No Service Providers found...</td></tr>";
                } else {
                    providers.forEach(function(provider) {
                        var avgRating = parseFloat(provider.avg_rating);
                        tbody += "<tr>" +
                            "<td><img style='height:150px' src='images/" + provider.photo + "'/></td>" +
                            "<td>" + provider.name + "</td>" +
                            "<td>" + provider.adder1 + ",<br>" + provider.adder2 + ",<br>" + provider.city + "</td>" +
                            "<td>" + provider.profession + "</td>" +
                            "<td>" + (isNaN(avgRating) ? 'No ratings yet' : avgRating.toFixed(1)) + "</td>" +
                            "<td><a href='booking.php?provider=" + provider.id + "' class='btn btn-primary btn-block'>Book</a></td>" +
                            "<td><a href='rate_provider.php?provider_id=" + provider.id + "' class='btn btn-secondary btn-block'>Rate</a></td>" +
                            "</tr>";
                    });
                }
                $("#providers tbody").html(tbody);
            });
        }
    });

   
    $("#submitRating").click(function() {
        var providerId = $("#providerId").val();
        var rating = $("#rating").val();
        var comments = $("#comments").val();

        $.post('scripts/rate_provider.php', {
            provider_id: providerId,
            rating: rating,
            comments: comments
        }, function(res) {
            var response = JSON.parse(res);
            if (response.success) {
                alert('Rating submitted successfully!');
                $("#search").click();
            } else {
                console.error('Failed to update rating:', response.error);
                alert('Failed to update rating. Please try again.');
            }
        });
    });

});

</script>

<style>
    .profession-selection .row {
        margin-bottom: 10px;
    }
    .profession-img {
        cursor: pointer;
        width: 100%;
        height: 100px;
        border: 2px solid transparent;
        border-radius: 10px;
    }

    .profession-img.selected {
        border-color: #007bff;
    }
    body {
        background: url('images/tryy.jpg') no-repeat center center fixed;
        background-size: cover;
        
       
    }
    

    .jumbotron {
        background: rgba(255, 255, 255, 0.8);
        color:#333;
        padding:5px;
        border-radius: 50px;
        width:100%;
    }
    .table-responsive{
        background: rgba(255, 255, 255, 0.5);
        color:#333;
        font-size: 18px;
        
    }
    table, th, td {
    color: black; 
    
}

   
</style>

<?php include_once "./include/footer.php"; ?>