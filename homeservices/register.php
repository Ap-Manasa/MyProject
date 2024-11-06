<?php include_once "./include/header.php"; ?>

<?php
$cities = ["Whitefield", "Koramangala", "Indiranagar", "Jayanagar", "Marathahalli", "Electronic City", "HSR Layout", "Banashankari", "Basavanagudi", "Malleshwaram", "Rajajinagar", "Frazer Town", "Yelahanka", "Hebbal", "BTM Layout", "Ulsoor", "Sarjapur Road", "Bellandur", "Kalyan Nagar", "JP Nagar", "KR Puram", "Hennur", "Banaswadi", "Nagawara", "Majestic", "MG Road", "Richmond Town", "Shantinagar", "Cox Town", "Basaveshwaranagar", "Vijayanagar", "Nagarbhavi", "Uttarahalli", "RT Nagar", "Kadugodi", "Domlur", "Kengeri", "Banerghatta Road", "HBR Layout", "Kammanahalli", "Peenya", "Mahadevapura", "Yeshwanthpur", "Sadashivanagar", "Chandra Layout", "JP Nagar", "Mysore Road", "Kumaraswamy Layout", "Varthur", "Nagasandra", "Kanakapura Road", "Vidyaranyapura", "Devanahalli", "Anekal", "Horamavu", "Jakkur", "Lingarajapuram", "Thanisandra", "Vignana Nagar", "Kogilu", "Bommanahalli", "Jeevan Bima Nagar", "Hoysala Nagar", "Anjanapura", "Jalahalli", "Sunkadakatte", "Hegde Nagar", "Attibele", "Kadubeesanahalli", "Singasandra", "Begur", "Byrasandra", "Vasanth Nagar", "Adugodi", "Puttenahalli", "Vittal Mallya Road", "Magadi Road", "Manjunath Nagar", "Vidya Nagar", "Doddanekundi", "Doddaballapur", "Cox Town", "Billekahalli", "Avalahalli", "Kaikondrahalli", "Haralur Road", "Arekere", "Chikbanavara", "Doddakammanahalli", "Medahalli", "Sahakara Nagar", "Srirampura", "Hesaraghatta", "Hunasamaranahalli", "Singapura Layout", "Garudacharpalya", "RMV Extension", "Vidyaranyapura", "Kamala Nagar", "Bommasandra"];
?>
<style>
    body {
        background: url('images/tryy.jpg') no-repeat center center fixed;
        background-size: cover;  
    }
</style>
<?php include_once "msg/register.php"; ?>
<div class="container" style="margin-top: 30px; max-width: 500px;margin-bottom: 60px ;">
    <div class="card" style="border-radius: 35px ;">
        <div class="card-body">
            <div class="card-title">
                <h3 class="text-center">Register as Service Provider</h3>
            </div>
            <hr>


            <form action="scripts/register.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Name</label>
                    <input id="name" name="name" type="text" class="form-control" placeholder="Name" required>
                </div>

                <div class="form-group">
                    <label for="contact">Contact No.</label>
                    <input id="contact"           oninput="formatPhoneNumber(this)" name="contact" type="text" class="form-control" placeholder="Contact" minlength="10" maxlength="13" required>
                </div>

                <script>
                    function formatPhoneNumber(input) {
    // Remove all non-digits
                    let phoneNumber = input.value.replace(/\D/g, '');

    // Format as +91XXXXXXXXXX
                    if (phoneNumber.length >= 10) { phoneNumber = '+91' + phoneNumber.substr(-10); }

    // Update the input value
                    input.value = phoneNumber;
                }
                </script>


                <div class="form-group">
                    <label for="">Address Line 1</label>
                    <input id="adder1" name="adder1" type="text" class="form-control" placeholder="Enter Address line-1"
                        required>
                </div>

                <div class="form-group">
                    <label for="">Address Line 2</label>
                    <input id="adder2" name="adder2" type="text" class="form-control" placeholder="Enter Address line-2"
                        required>
                </div>

                <div class="form-group">
                    <label for="">City</label>
                    <select class="form-control" name="city" id="city">
                        <?php foreach ($cities as $city) : ?>
                        <option value="<?= $city ?>"> <?= $city ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Photo(Square Size)</label>
                    <input id="photo" name="photo" type="file" class="form-control-file" placeholder="Select Photo 1"
                        required>
                </div>

                <div class="form-group">
                    <label for="">Add Description</label>
                    <textarea name="descr" id="descr" class="form-control" cols="30" rows="5"
                        placeholder="Tell something about you..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="">Password</label>
                    <input id="password" name="password" type="password" class="form-control"
                        placeholder="Enter 6 Character Password" minlength="4" required>
                </div>

                <div class="form-group">
                    <label for="">Profession</label>
                    <select class="form-control" name="profession" id="profession">
                        <option value="electrician">Electrician</option>
                        <option value="plumber">Plumber</option>
                        <option value="painter">Painter</option>
                        <option value="carpenter">Carpenter</option>
                        <option value="tutor">Tutor</option>
                        <option value="pet">Pet Grooming</option>
                        <option value="pest">Pest Control</option>
                        <option value="cleaner">Home Cleaner</option>
                    </select>
                </div>

                <button style="margin-top: 30px;" class="btn btn-block btn-primary" type="submit" name="register"
                    id="register">Register</button>
            </form>

        </div>
    </div>
</div>

<?php include_once "./include/footer.php";
