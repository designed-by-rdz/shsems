<!DOCTYPE html>
<?php
    include 'con/con.php';
?>
<html lang="en" style="height:100%">
<head>
    <title><?= urldecode($data['school']) ?> | SHSEMS Sign Up</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <link rel="stylesheet" type="text/css" href="css/pico.classless.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/icon.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="height:100%">
    <back>
        <card style="scale:0.8">
            <img src="img/logo.png" class="logo-card">
            <h1><?= urldecode($data['school']) ?></h1> 
            <h3>Sign Up</h3>
            <form method="post" action="ssn/signup.php" onsubmit="return confirm('Sign up for an account?');">
                <?php 
                    if (isset($_SESSION['code'])) {
                        echo "<notice id='notification' class='". $_SESSION['code'] ."'>". $_SESSION['msg']."</notice>";
                        unset($_SESSION['code']);
                    }
                ?>
                <label>
                    Username<req>*</req>
                    <input type="text" name="l-sign" id="l-sign" maxlength="100" required>
                </label>   
                <label>
                    Password<req>*</req>
                    <input type="password" name="l-pass" id="l-pass" maxlength="100" required>
                </label> 
                <label>
                    Re-enter Password<req>*</req>
                    <input type="password" name="l-passt" id="l-passt" maxlength="100" required>
                </label>   
                <label>
                    User Type<req>*</req>
                    <select name="l-type" id="l-type" required>
                        <optgroup>
                            <?php 
                                $gettypes = mysqli_query($connect,"SELECT * FROM tblRoles ORDER BY role_code DESC");
                                while ($types = mysqli_fetch_array($gettypes)) {
                                    $type = $types[0];
                                    if ($type != "Administrator") {
                                        echo "<option value='$type'>$type</option>";
                                    }
                                }
                            ?>
                        </optgroup>
                    </select>
                </label>                
                <label>
                    Enter CAPTCHA Code<req>*</req>
                    <div class="captcha-line">
                    <img class="register-captcha" src="inc/captcha.php">
                    <input type="text" name="l-capt" id="l-capt" maxlength=5 required>
                    </div>
                </label>          
                <fieldset>
                    <legend>Terms and Conditions<req>*</req></legend>
                    <div>
                    <input type="checkbox" id="l-pax" name="l-perm" value="OK" required/>I agree to the <a style="cursor:pointer" onclick="document.getElementById('modal-terms').open = true">Terms and Conditions</a> and the <a style="cursor:pointer" onclick="document.getElementById('modal-policy').open = true">Privacy Policy</a> of the website.
                            </div>
                </fieldset>
                <input type="submit" value="Sign Up">
            </form>
            <div>Already have an account? <a href="login.php">Sign in</a></div><br>
        </card>
    </back>
</body>

<dialog id='modal-terms'>
  <article>
    <header>
      <button aria-label="Close" rel="prev" onclick="document.getElementById('modal-terms').close()"></button>
      <p><strong>Terms and Agreement</strong></p>
    </header>
    <div>
    
    <header>
        <h2>Senior High School Enrollment Management System</h2>
        <h3>Daniel R. Aguinaldo National High School</h3>
        <p><em>Last Updated: November 8, 2025</em></p>
    </header>

    <section id="introduction">
        <h2>1. Introduction</h2>
        <p>
            Welcome to the <strong>Senior High School Enrollment Management System</strong> (“the System”) 
            of <strong>Daniel R. Aguinaldo National High School (DRANHS)</strong>.
            By accessing and using this website, you (“User”) agree to comply with and be bound by the following 
            Terms and Conditions. These terms govern your access, registration, use, and participation in the online 
            enrollment process for Senior High School students.
        </p>
        <p>If you do not agree with these terms, please refrain from using the System.</p>
    </section>

    <section id="definition-of-users">
        <h2>2. Definition of Users</h2>
        <p>The System distinguishes between the following user roles:</p>
        <ul>
            <li><strong>Student Users:</strong> Individuals who are applying or enrolling in DRANHS Senior High School programs.</li>
            <li><strong>Faculty Users:</strong> Authorized school personnel who perform evaluation and encoding tasks during the enrollment process.</li>
            <li><strong>Administrator:</strong> Authorized personnel responsible for system maintenance, user management, and data oversight.</li>
        </ul>
    </section>

    <section id="use-of-system">
        <h2>3. Use of the System</h2>
        <ol>
            <li>The System is intended solely for official enrollment-related activities at DRANHS.</li>
            <li>Users must ensure that all information provided during registration and document submission is <strong>accurate, truthful, and complete</strong>.</li>
            <li>Any attempt to submit fraudulent information or documents is strictly prohibited and may result in disqualification or administrative action.</li>
            <li>Unauthorized access, modification, or misuse of the System or its data is a violation of school policy and applicable laws.</li>
        </ol>
    </section>

    <section id="account-security">
        <h2>4. Account Registration and Security</h2>
        <ol>
            <li>Users are responsible for maintaining the confidentiality of their login credentials.</li>
            <li>Users agree to promptly notify the school of any unauthorized access or suspected breach of their account.</li>
            <li>The school reserves the right to suspend or deactivate accounts found to be compromised, inactive, or misused.</li>
            <li>Faculty accounts are restricted to authorized DRANHS personnel only and must be used strictly for official functions (evaluation or encoding).</li>
        </ol>
    </section>

    <section id="document-verification">
        <h2>5. Document Upload and Verification</h2>
        <ol>
            <li>Students are required to upload necessary documents (e.g., report cards, birth certificates, good moral certificates) in the prescribed format.</li>
            <li>Uploaded documents are subject to verification by the designated <strong>Evaluator Faculty</strong>.</li>
            <li>Only documents verified and approved by Evaluators will proceed to the <strong>Encoder Faculty</strong> for final enrollment processing.</li>
            <li>The school reserves the right to reject unclear, falsified, or incomplete submissions.</li>
        </ol>
    </section>

    <section id="data-ownership">
        <h2>6. Data Ownership and Use</h2>
        <p>
            All information and documents submitted through the System remain the property of 
            <strong>Daniel R. Aguinaldo National High School</strong> and are used solely for educational and administrative 
            purposes related to enrollment and student records management.
        </p>
    </section>

    <section id="system-maintenance">
        <h2>7. System Availability and Maintenance</h2>
        <p>
            While the school endeavors to maintain uninterrupted access, DRANHS does not guarantee continuous or 
            error-free operation of the System. Scheduled maintenance or technical issues may temporarily limit access. 
            The school is not liable for any inconvenience, data loss, or delays caused by such events.
        </p>
    </section>

    <section id="prohibited-activities">
        <h2>8. Prohibited Activities</h2>
        <p>Users shall not:</p>
        <ul>
            <li>Attempt to hack, disable, or disrupt the System.</li>
            <li>Access or modify data belonging to other users.</li>
            <li>Use automated scripts or programs to interact with the System.</li>
            <li>Share confidential information obtained through authorized access.</li>
        </ul>
        <p>
            Violations may result in account termination, disqualification from enrollment, and potential legal action.
        </p>
    </section>

    <section id="liability">
        <h2>9. Limitation of Liability</h2>
        <p>
            Daniel R. Aguinaldo National High School, its faculty, and staff shall not be held liable for:
        </p>
        <ul>
            <li>Losses or damages resulting from misuse of the System.</li>
            <li>Errors in user-provided data or documents.</li>
            <li>System downtime, technical issues, or internet connectivity problems.</li>
        </ul>
    </section>

    <section id="amendments">
        <h2>10. Amendments</h2>
        <p>
            DRANHS reserves the right to update or modify these Terms and Conditions at any time. 
            Users will be notified of significant changes through the System or the official school website.
        </p>
    </section>

    <section id="acceptance">
        <h2>11. Acceptance</h2>
        <p>
            By creating an account, submitting documents, or using the System, you acknowledge that you have read, understood, 
            and agree to these Terms and Conditions.
        </p>
    </section>

    <section id="contact-info">
        <h2>12. Contact Information</h2>
        <address>
            <p><strong>Enrollment Committee – Daniel R. Aguinaldo National High School</strong></p>
            <p>Email: [Insert official school email]</p>
            <p>Address: [Insert official school address]</p>
            <p>Phone: [Insert school contact number]</p>
        </address>
    </section>

    </div>
  </article>
</dialog>
<dialog id='modal-policy'>
  <article>
    <header>
      <button aria-label="Close" rel="prev" onclick="document.getElementById('modal-policy').close()"></button>
      <p><strong>Privacy Policy</strong></p>
    </header>
    <div>
        
<header>
        <h2>Senior High School Enrollment Management System</h2>
        <h3>Daniel R. Aguinaldo National High School</h3>
        <p><em>Last Updated: November 8, 2025</em></p>
    </header>

    <section id="introduction">
        <h2>1. Introduction</h2>
        <p>
            This Privacy Policy explains how <strong>Daniel R. Aguinaldo National High School (DRANHS)</strong> 
            collects, uses, stores, and protects personal information submitted through the 
            <strong>Senior High School Enrollment Management System</strong> (“the System”).
        </p>
        <p>
            By registering or using this System, you consent to the collection and processing of your personal data in 
            accordance with this Privacy Policy and the provisions of the 
            <em>Data Privacy Act of 2012 (Republic Act No. 10173)</em>.
        </p>
    </section>

    <section id="information-collected">
        <h2>2. Information We Collect</h2>
        <p>
            The System collects the following categories of information for the purpose of enrollment and school administration:
        </p>
        <ul>
            <li><strong>Personal Information:</strong> Full name, date of birth, address, contact number, email address, and other identifying details.</li>
            <li><strong>Academic Information:</strong> Previous school attended, report card details, learning modality preferences, and strand choices.</li>
            <li><strong>Parent/Guardian Information:</strong> Names, contact details, and relationship to the student.</li>
            <li><strong>Uploaded Documents:</strong> Birth certificate, report card, good moral certificate, and other enrollment-related documents.</li>
            <li><strong>System Data:</strong> Account credentials, user activity logs, and timestamps of logins or submissions.</li>
        </ul>
    </section>

    <section id="purpose">
        <h2>3. Purpose of Data Collection</h2>
        <p>
            The information collected through the System is used exclusively for legitimate educational and administrative purposes, including:
        </p>
        <ul>
            <li>Processing of student enrollment and academic records.</li>
            <li>Verification of submitted documents.</li>
            <li>Assignment of students to sections and academic strands.</li>
            <li>Communication with students and parents regarding enrollment status.</li>
            <li>Preparation of official school reports and statistics.</li>
            <li>System improvement and technical maintenance.</li>
        </ul>
    </section>

    <section id="data-storage">
        <h2>4. Data Storage and Retention</h2>
        <p>
            All collected information is securely stored within the school’s authorized servers or databases. 
            Access to data is strictly limited to authorized personnel such as the Enrollment Committee, Evaluators, and Encoders.
        </p>
        <p>
            Personal data will be retained only for as long as necessary to fulfill the purposes stated in this Policy, 
            unless a longer retention period is required by applicable laws or school regulations.
        </p>
    </section>

    <section id="data-protection">
        <h2>5. Data Protection and Security</h2>
        <p>
            DRANHS implements appropriate organizational, physical, and technical measures to ensure the confidentiality, 
            integrity, and availability of personal information, including:
        </p>
        <ul>
            <li>Encryption of sensitive information during data transmission and storage.</li>
            <li>Restricted access to authorized school personnel only.</li>
            <li>Regular system audits and security updates.</li>
            <li>Secure disposal of printed or digital documents containing personal data.</li>
        </ul>
        <p>
            Despite these measures, users acknowledge that no electronic storage or data transmission method is completely secure, 
            and the school cannot guarantee absolute data security.
        </p>
    </section>

    <section id="data-sharing">
        <h2>6. Data Sharing and Disclosure</h2>
        <p>
            DRANHS does not sell, trade, or rent personal data to third parties. However, data may be shared under the following circumstances:
        </p>
        <ul>
            <li>With <strong>DepEd</strong> or other authorized government agencies for reporting and compliance purposes.</li>
            <li>With authorized service providers for system maintenance or data processing, under strict confidentiality agreements.</li>
            <li>When required by law, court order, or legal process.</li>
        </ul>
    </section>

    <section id="user-rights">
        <h2>7. User Rights</h2>
        <p>
            In accordance with the <em>Data Privacy Act of 2012</em>, users have the following rights:
        </p>
        <ul>
            <li>The right to be informed about how their data is collected and used.</li>
            <li>The right to access their personal data held by the school.</li>
            <li>The right to correct or update inaccurate or incomplete data.</li>
            <li>The right to object to the processing of their personal data, subject to legal and administrative considerations.</li>
            <li>The right to file a complaint with the National Privacy Commission (NPC) if data privacy rights are violated.</li>
        </ul>
        <p>
            Requests to exercise these rights may be directed to the school’s Data Protection Officer or Enrollment Committee.
        </p>
    </section>

    <section id="cookies">
        <h2>8. Use of Cookies and Tracking Technologies</h2>
        <p>
            The System may use cookies or similar technologies to enhance user experience and improve website functionality. 
            Cookies are small text files stored on your device that help recognize repeat users and track usage patterns. 
            Users may choose to disable cookies through their browser settings, but certain features of the System may not function properly as a result.
        </p>
    </section>

    <section id="updates">
        <h2>9. Updates to this Privacy Policy</h2>
        <p>
            DRANHS reserves the right to revise or update this Privacy Policy at any time. 
            Any significant changes will be announced through the System or the official school communication channels. 
            Continued use of the System after such updates constitutes acceptance of the revised policy.
        </p>
    </section>

    <section id="contact-info">
        <h2>10. Contact Information</h2>
        <p>
            For questions, concerns, or data privacy-related requests, please contact:
        </p>
        <address>
            <p><strong>Data Protection Officer / Enrollment Committee</strong></p>
            <p><strong>Daniel R. Aguinaldo National High School</strong></p>
            <p>Email: [Insert official school email]</p>
            <p>Address: [Insert official school address]</p>
            <p>Phone: [Insert school contact number]</p>
        </address>
    </section>

    </div>
  </article>
</dialog>
<script src="js/script.js"></script>
</html>
<!-- ADD PRIVACY POLICY AND TERMS AND AGREEMENTS -->