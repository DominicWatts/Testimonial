## Magento 2 Testimonials ##

Frontend controller to display testimonials and allow submission. Backend moderation screens.

# Install instructions #

`composer require dominicwatts/testimonial`

`php bin/magento setup:upgrade`

`php bin/magento setup:di:compile`

# Usage instructions #

Add testimonials either through the backend or frontend.  Make sure at least one testimonial has been approved.

Go to:

  -  `/testimonials` to submit
  -  `/testimonaisl/index/view` to view

## Submit screen ##

![Submit](https://i.snag.gy/s5YP4n.jpg)

## View screen ##

![View](https://i.snag.gy/N9oSDZ.jpg)

To moderate in admin

Go to Marketing > Testimonials

## Backend moderation ## 

![Backend](https://i.snag.gy/YhdXBz.jpg)

Also there is a console command to generate obvious fake entries

## Generate Faker Testimonial ##

`xigen:faker:testimonial [-l|--limit [LIMIT]] [--] <generate>`

php/bin magento xigen:faker:testimonial generate

php/bin magento xigen:faker:testimonial -l 10 generate