<!-- slider component -->
<!-- ik heb de comments hier geschreven in het engels omdat de github engels is niet omdat het is geschreven door copilot lol -->
<?php


// check if the values are set, if not set them to default values
isset($max_price) ? $max_price : $max_price = 300;
isset($left_bound) ? $left_bound : $left_bound = 1;
isset($right_bound) ? $right_bound : $right_bound = $max_price;

// round up the values
$max_price = (int)ceil($max_price);
$right_bound = (int)ceil($right_bound);
$left_bound = (int)ceil($left_bound);

?>

<div class=" main">
    <div class="custom-wrapper">
        <div class="price-input-container">
            <div class="price-input">
                <div class="price-field">
                    <span>Minimum prijs</span>
                    <input type="number" class="min-input" value="<?= $left_bound ?? 1 ?>">
                </div>
                <div class="price-field">
                    <span>Maximum prijs</span>
                    <input type="number" class="max-input" value="<?= $right_bound ?? $max_price ?>">
                </div>
            </div>
            <div class="slider-container">
                <div class="price-slider bg-emerald-300">
                </div>
            </div>
        </div>

        <!-- Slider -->
        <div class="range-input">
            <input type="range" name="filter_price_min" class="min-range" min="1" max="<?= $max_price ?>"
                value="<?= $left_bound ?? 1 ?>" step="1">
            <input type="range" name="filter_price_max" class="max-range" min="1" max="<?= $max_price ?>"
                value="<?= $right_bound ?? $max_price ?>" step="1">
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to initialize the slider values and styles
        function initializeSlider() {
            const rangevalue = document.querySelector(".slider-container .price-slider");
            const rangeInputvalue = document.querySelectorAll(".range-input input");
            const priceInputvalue = document.querySelectorAll(".price-input input");

            let minVal = parseInt(rangeInputvalue[0].value);
            let maxVal = parseInt(rangeInputvalue[1].value);

            rangevalue.style.left = `${(minVal / rangeInputvalue[0].max) * 100}%`;
            rangevalue.style.right = `${100 - (maxVal / rangeInputvalue[1].max) * 100}%`;
        }

        // Call the initialize function when the page loads
        initializeSlider();

        const rangevalue = document.querySelector(".slider-container .price-slider");
        const rangeInputvalue = document.querySelectorAll(".range-input input");

        // Set the price gap
        let priceGap = 10;

        // Adding event listeners to price input elements

        const priceInputvalue = document.querySelectorAll(".price-input input");
        for (let i = 0; i < priceInputvalue.length; i++) {
            priceInputvalue[i].addEventListener("input", e => {
                // Parse min and max values of the range input
                let minp = parseInt(priceInputvalue[0].value);
                let maxp = parseInt(priceInputvalue[1].value);
                let diff = maxp - minp;

                if (minp < 0) {
                    alert("minimum price cannot be less than 0");
                    priceInputvalue[0].value = 0;
                    minp = 0;
                }

                // Validate the input values
                if (maxp > rangeInputvalue[1].max) {
                    alert("maximum price cannot be greater than 300");
                    priceInputvalue[1].value = rangeInputvalue[1].max;
                    maxp = rangeInputvalue[1].max;
                }

                if (minp > maxp - priceGap) {
                    priceInputvalue[0].value = maxp - priceGap;
                    minp = maxp - priceGap;

                    if (minp < 0) {
                        priceInputvalue[0].value = 0;
                        minp = 0;
                    }
                }

                // Check if the price gap is met 
                // and max price is within the range
                if (diff >= priceGap && maxp <= rangeInputvalue[1].max) {
                    if (e.target.className === "min-input") {
                        rangeInputvalue[0].value = minp;
                        let value1 = rangeInputvalue[0].max;
                        rangevalue.style.left = `${(minp / value1) * 100}%`;
                    } else {
                        rangeInputvalue[1].value = maxp;
                        let value2 = rangeInputvalue[1].max;
                        rangevalue.style.right = `${100 - (maxp / value2) * 100}%`;
                    }
                }
            });
        }

        // Add event listeners to range input elements
        for (let i = 0; i < rangeInputvalue.length; i++) {
            rangeInputvalue[i].addEventListener("input", e => {
                let minVal = parseInt(rangeInputvalue[0].value);
                let maxVal = parseInt(rangeInputvalue[1].value);
                let diff = maxVal - minVal;

                // Check if the price gap is exceeded
                if (diff < priceGap) {
                    // Check if the input is the min range input
                    if (e.target.className === "min-range") {
                        rangeInputvalue[0].value = maxVal - priceGap;
                    } else {
                        rangeInputvalue[1].value = minVal + priceGap;
                    }
                } else {
                    // Update price inputs and range progress
                    priceInputvalue[0].value = minVal;
                    priceInputvalue[1].value = maxVal;
                    rangevalue.style.left = `${(minVal / rangeInputvalue[0].max) * 100}%`;
                    rangevalue.style.right = `${100 - (maxVal / rangeInputvalue[1].max) * 100}%`;
                }
            });
        }
    });
</script>