<?php
session_start();

if (isset($_SESSION["user"])) {

    $title = "DashBoard";
    require('./header.php');
?>

    <div class="row mb-3">
        <div class="d-flex flex-column flex-md-row justify-content-center align-items-center">
            <div class="col-12 col-md-4 bg-dark text-light text-center border border-1 rounded m-3 py-4">
                <?php
                $get_studentCount_rs = Database::search("SELECT COUNT(`id`) AS `count` FROM `studentdata`");
                $row = $get_studentCount_rs->fetch_assoc();
                $get_studentCount_num = $row['count'];
                ?>
                <h1>Student Count</h1>
                <h3><?php echo $get_studentCount_num; ?></h3>
            </div>
            <div class="col-12 col-md-8">

                <!-- student select -->
                <div class="d-flex flex-column mx-5">
                    <label for="">Select student name / id</label>
                    <select class="form-select rounded-pill text-center" id="selectedStudent" onchange="studentIdForStudentProfile(this.value)">
                        <option value="" selected disabled>---Select student---</option>
                        <?php
                        $set_studentdata_rs = Database::search("SELECT `id`,`name` FROM studentdata");
                        while ($set_studentdata_data = $set_studentdata_rs->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $set_studentdata_data["id"] ?>"><?php echo $set_studentdata_data["name"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-2 d-flex align-items-center">
        <div class="col-12 col-md-6">
            <h2>Send whatsapp message</h2>
        </div>
        <div class="col-12 col-md-6">
            <div class="input-group mb-3">
                <input type="text" id="studentWhatsappNumber" class="form-control" value="+94" placeholder="Enter whatsApp number (Ex: +9477#######)" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-dark" type="button" onclick="sendWhatsAppMsg('<?php echo $pageData['domain'] ?>')">SEND</button>
                </div>
            </div>
        </div>
    </div>

<?php
    require('./footer.php');
} else {
    header('Location: ./index.php');
    exit();
}
?>