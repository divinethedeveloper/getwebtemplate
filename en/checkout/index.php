<?php

require_once "../../backend/conn.php";
// Fetch template with id = 1

if (isset($_GET['id'])) {
    $page_id = $_GET['id'];
 
}


$template_id = $page_id; // You can dynamically set this value as required
$sql = "SELECT * FROM templates WHERE id = $template_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $template = $result->fetch_assoc();
} else {
    echo "No template found!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($template['name']); ?></title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/shop.css">
    <link rel="stylesheet" href="../../css/checkout.css">
    <link rel="stylesheet" href="../../css/glass.css">
    <link rel="stylesheet" href="../../css/nav.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
</head>
<body>
    <div class="container">
        <?php require_once "../../components/nav.php"; ?>
        <div class="content cen">
            <div class="shots">
                <div class="wrap">
                <?php
                // Loop through the possible shots (shot_1 to shot_10)
                for ($i = 1; $i <= 10; $i++) {
                    if (!empty($template["shot_$i"])) {
                        echo '<div class="shot s' . $i . ($i === 1 ? ' active' : '') . '" onclick="previewImage(this)">';
                        echo '<img alt="Template Screenshot ' . $i . '" src="../../backend/' . htmlspecialchars($template["shot_$i"]) . '">';
                        echo '</div>';
                    }
                }
                ?>
                </div>
            </div>
            
            <!-- Preview Modal -->
            <div id="imagePreviewModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 1000;">
                <span onclick="closePreview()" style="position: absolute; right: 25px; top: 15px; color: white; font-size: 35px; cursor: pointer;">&times;</span>
                <img id="previewImage" style="max-width: 90%; max-height: 90%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            </div>
        </div>

        <script>
            function previewImage(element) {
                const modal = document.getElementById('imagePreviewModal');
                const previewImg = document.getElementById('previewImage');
                const sourceImg = element.querySelector('img');
                
                previewImg.src = sourceImg.src;
                modal.style.display = 'block';
                
                // Prevent body scrolling when modal is open
                document.body.style.overflow = 'hidden';
            }

            function closePreview() {
                document.getElementById('imagePreviewModal').style.display = 'none';
                document.body.style.overflow = 'auto';
            }

            // Close modal when clicking outside the image
            document.getElementById('imagePreviewModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closePreview();
                }
            });
        </script>

        <div class="buttons">
            <button class="btn" id="prev">Prev</button>
            <button class="btn" id="next">Next</button>
        </div>

        <div class="preview cen">

                <button class="btn fp" onclick="location.href='../preview/?id=<?php echo $template_id; ?>'">Preview</button>


        </div>


        <div class="product_desc">
            <h6><?php echo htmlspecialchars($template['category']); ?></h6>
            <h1 class="product_name">
                <?php echo htmlspecialchars($template['name']); ?>
            </h1>
            <h4 class="price">$<?php echo number_format($template['price'], 2); ?></h4>
            <aside class="description">
                <?php echo htmlspecialchars($template['short_description']); ?>
            </aside>
            <div class="buy_now" onclick="handleBuyNow()">
                Buy Now
            </div>
            <div class="dash">
                <ul>
                    <li>✓ Instant dashboard access to download your template for wordpress, custom code or other CMS's</li>
                    <li>✓ Optional professional setup service available</li>
                    <li>✓ 30-day money-back guarantee</li>
                </ul>
            </div>
        </div>

        <h3 class="mt5">Similar Templatesss</h3>
        <div class="templates">
            <?php
            // Fetch other templates for similar suggestions
            $similar_sql = "SELECT * FROM templates WHERE id != $template_id LIMIT 3";
            $similar_result = $conn->query($similar_sql);

            if ($similar_result->num_rows > 0) {
                while ($similar_template = $similar_result->fetch_assoc()) {
                    echo '<div class="template" onclick="location.href=\'../checkout/?id=' . $similar_template['id'] . '\'">';
                    echo '<div class="gif">';
                    echo '<img src="../../assets/gif.gif" alt="Template Preview">';
                    echo '</div>';
                    echo '<div class="t_scroll">';
                    echo '<img src="../../backend/' . htmlspecialchars($similar_template['main_image']) . '" alt="Template Image">';
                    echo '</div>';
                    echo '<h4>' . htmlspecialchars($similar_template['name']) . '</h4>';
                    echo '</div>';
                }
            }

            ?>
        </div>
    </div>


    <script>
     

// First, define the Paystack function
function payWithPaystack(email) {
    let handler = PaystackPop.setup({
        key: 'pk_live_00534fd721dcafd1455164b51e4ac43922104c9a',
        email: email, // Use the email from input
        amount: <?php echo (($template['price'] * 100) * 15.8); ?>,
        currency: 'GHS',
        ref: '' + Math.floor((Math.random() * 1000000000) + 1),
        metadata: {
            custom_fields: [
                {
                    template_id: "<?php echo $template_id; ?>",
                    template_name: "<?php echo htmlspecialchars($template['name']); ?>"
                }
            ]
        },
        callback: function(response) {
            window.location.href = `../success?reference=${response.reference}`;
        },
        onClose: function() {
            alert('Transaction was not completed, window closed.');
        }
    });
    handler.openIframe();
}

// Function to handle the buy now click
function handleBuyNow() {
    Swal.fire({
        title: 'Enter your email',
        html: `
            <input 
                type="email" 
                id="swal-input-email" 
                class="swal2-input" 
                placeholder="your@email.com"
                style="
                    width: 80%;
                    padding: 12px;
                    margin: 10px auto;
                    border: 1px solid #ddd;
                    border-radius: 8px;
                    font-size: 16px;
                    outline: none;
                "
            >
        `,
        showCancelButton: true,
        confirmButtonText: 'Continue',
        cancelButtonText: 'Cancel',
        customClass: {
            popup: 'custom-popup',
            confirmButton: 'custom-confirm',
            cancelButton: 'custom-cancel'
        },
        preConfirm: () => {
            const email = document.getElementById('swal-input-email').value;
            if (!email || !email.includes('@')) {
                Swal.showValidationMessage('Please enter a valid email address');
                return false;
            }
            return email;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            payWithPaystack(result.value);
        }
    });
}

// Add this CSS to your head section or stylesheet
document.head.insertAdjacentHTML('beforeend', `
    <style>
        .custom-popup {
            border-radius: 15px;
            padding: 20px;
        }
        
        .custom-confirm {
            background: #333 !important;
            border-radius: 8px !important;
            padding: 12px 24px !important;
            margin-top: 20px !important;
        }
        
        .custom-cancel {
            background: #fff !important;
            color: #333 !important;
            border: 1px solid #ddd !important;
            border-radius: 8px !important;
            padding: 12px 24px !important;
            margin-top: 20px !important;
        }
        
        .swal2-popup {
            width: 400px !important;
        }
        
        #swal-input-email:focus {
            border-color: #333;
            box-shadow: 0 0 0 2px rgba(51,51,51,0.1);
        }
    </style>
`);

// Update your buy now button to use this function
document.querySelector('.buy_now').onclick = handleBuyNow;

      </script>





    <script src="../../scripts/script.js"></script>

    
</body>
</html>