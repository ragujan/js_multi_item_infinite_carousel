<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="output.css">
    <title>Document</title>
    <style>
        .fakeClass {}
    </style>
</head>

<body>


    <div id="carouselContainer" class="w-[80%] m-auto overflow-scroll">
        <div id="carousel" class="flex w-full bg-green-500 ">


            <?php
            for ($i = 0; $i < 5; $i++) {
            ?>
                <div class="fakeClass flex-shrink-0 flex-grow-0 basis-[100%] md:basis-[50%] lg:basis-[33.33%]  border-2 border-red-500  p-3 h-32 bg-gray-300 ">

                    Item <?= $i + 1 ?>

                </div>
            <?php
            }
            ?>
            <!-- Add more items as needed -->
        </div>
    </div>

    <button id="prev" class="p-2 mt-3 bg-yellow-400">prev</button>
    <button id="next" class="p-2 mt-3 bg-yellow-400">next</button>

    <script>
        const nextButton = document.getElementById('next');
        // it does nothing for now
        const prevButton = document.getElementById('prev');
        const transitionDuration = 700;

        // this is the carousel 
        const carousel = document.getElementById('carousel');
        // total carousel width if its 3000 because I added 10 300px images 
        const carouselWidth = Math.round(carousel.getBoundingClientRect().width);
        // this is the first slide 
        let firstSlide = carousel.getElementsByClassName('fakeClass')[0];
        // all the slides
        let slides = carousel.getElementsByClassName('fakeClass');
        // first slides length, I any slides length 
        let firstSlideLength = Math.round(firstSlide.getBoundingClientRect().width);
        // every slides length, if 10 slides with 300px width, then its 3000px
        let slideTotalLength = Math.round(slides.length * firstSlideLength);
        // how many slides you want to show 
        let slidesPerView = Math.round(carouselWidth / firstSlideLength)
        // we don't need countgap any more, just ignore it
        let countGap = slides.length;
        // original total slides 
        const actualTotalSlides = slides.length;

        let sliderPositionLeft = Math.round(carousel.getBoundingClientRect().left);

        let sliderActualPositionLeft = Math.round(carousel.getBoundingClientRect().left);


        // console.log("carousel width ", carouselWidth)
        // console.log("total slides width ", slideTotalLength)
        // console.log("carousel position ",Math.round(carousel.getBoundingClientRect().x));
        // console.log("slider position left is ",sliderPositionLeft) 
        // console.log("slider width ",firstSlideLength)
        console.log("slides per view ", slidesPerView)
        let currentIndex = 0;
        nextButton.addEventListener('click', () => {
            nextButton.disabled = true;
            carousel.style.transition = `margin ${transitionDuration}ms`

            sliderPositionLeft = Math.round(carousel.getBoundingClientRect().left);
            const translationAmount = sliderPositionLeft - firstSlideLength - sliderActualPositionLeft;
            // console.log("slider position left ",sliderPositionLeft)

            // console.log("slides per view is ", slidesPerView)
            // console.log("total slider length ", slideTotalLength)
            // console.log("slide length ", firstSlideLength)
            // console.log("translation amount ", translationAmount)
            // ignore this we don't need this anymore
            countGap = slides.length - currentIndex;


            // console.log("slider width is ",firstSlideLength)
            // console.log("slider position is", translationAmount)
            // console.log("translation amount is", translationAmount)
            carousel.style.marginLeft = `${translationAmount}px`


            currentIndex++;
            // console.log("slide length ", slides.length)
            // console.log("current index is ", currentIndex)
            // this is to prevent multiple quick clickings of the next button
            setTimeout(() => {
                nextButton.disabled = false;
            }, transitionDuration + 50)

        })

        const removeSlides = (elementSize) => {
            const parentElement = carousel;
            const childElements = parentElement.children;

            for (let i = 0; i < elementSize; i++) {

                if (childElements[0]) {
                    parentElement.removeChild(childElements[0]);
                }

            }
        }
        const addSlides = (elementSize) => {
            const parentElement = carousel;

            for (let i = 0; i < elementSize; i++) {

                parentElement.appendChild(slides[i].cloneNode(true));

            }
        }
        carousel.addEventListener('transitionend', () => {
            // console.log("current index is ", currentIndex)
            // console.log("total slide count is ", slides.length)
            if (currentIndex === slides.length - slidesPerView) {
                // if (currentIndex === slidesPerView + 1) {
                // if (countGap === slidesPerView + 1) {
                console.log("we are going to stop")
                addSlides(slides.length);

            }
            if (currentIndex === actualTotalSlides) {
                // if (currentIndex === 10) {
                console.log("this is where everything resets ")
                carousel.style.transition = `none`
                console.log("current index is ", currentIndex)
                removeSlides(currentIndex)

                carousel.style.marginLeft = `${0}px`
                currentIndex = 0;
            }

        })

        window.addEventListener('load', () => {
            // return;
            // console.log("current index is ", currentIndex)
            // console.log("total slide count is ", slides.length)
            // if (currentIndex === slides.length - slidesPerView) {
            if (currentIndex === actualTotalSlides - slidesPerView) {
                // if (currentIndex === slidesPerView + 1) {
                // if (countGap === slidesPerView + 1) {
                console.log("we are going to stop")

            }
            if (currentIndex === actualTotalSlides - slidesPerView) {
                // if (currentIndex === 10) {
                addSlides(slides.length);
                console.log("this is where everything resets ")
                carousel.style.transition = `none`
                console.log("current index is ", currentIndex)
                removeSlides(currentIndex)

                carousel.style.marginLeft = `${0}px`
                currentIndex = 0;
            }

        })
        const setCardWidth = () => {
            slides = carousel.getElementsByClassName('fakeClass');
            // this is the first slide 
            firstSlide = carousel.getElementsByClassName('fakeClass')[0];
            firstSlideLength = Math.round(firstSlide.getBoundingClientRect().width)
            slideTotalLength = Math.round(slides.length * firstSlideLength);
            // how many slides you want to show 
            slidesPerView = Math.round(carouselWidth / firstSlideLength)
            sliderActualPositionLeft = Math.round(carousel.getBoundingClientRect().left);
            for (let i = 0; i < slides.length; i++) {
                const element = slides[i]
                // console.log("previous slide width was ", element.style.width)
                // console.log("resizing slide widths")
                element.style.width = firstSlideLength + 'px';
                // console.log("current slide width is ", element.style.width)

            }
        }
        window.addEventListener('resize', () => {

           

            console.log("curent index is ", currentIndex)
            if (currentIndex === slides.length - slidesPerView) {
                // if (currentIndex === slidesPerView + 1) {
                // if (countGap === slidesPerView + 1) {
                
                console.log("resizing and adding and set card width")
                addSlides(slides.length);
                setCardWidth()
            }
            if (currentIndex === actualTotalSlides) {
                // if (currentIndex === 10) {
                console.log("this is where everything resets ")
                carousel.style.transition = `none`
                console.log("current index is ", currentIndex)
                removeSlides(currentIndex)

                carousel.style.marginLeft = `${0}px`
                currentIndex = 0;
            }


        })
    </script>
</body>

</html>