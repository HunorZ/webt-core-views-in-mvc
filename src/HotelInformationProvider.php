<?php

namespace Hunor\WebtCoreViewsInMvc;
class HotelInformationProvider
{
    static function getHotels(): array
    {
        return array(
            array(
                "name" => "The Plaza Hotel",
                "location" => "Location: New York City, USA",
                "information" => array(
                    "Overview" => "An iconic landmark located at the prestigious corner of Fifth Avenue and Central Park South, The
                    Plaza Hotel is synonymous with timeless elegance and luxury. Since its opening in 1907, it has been
                    a popular choice for celebrities, royalty, and discerning travelers. The hotel's opulent interiors,
                    adorned with Beaux-Arts décor, and its impeccable white-glove service make it a quintessential New
                    York experience.",
                    "Amenities" => "The Plaza offers the grandeur of old-world elegance with the comforts
                    of modern amenities, including luxurious rooms and suites, the famous Palm Court for afternoon tea,
                    several high-end dining options, a lavish Champagne Bar, the renowned Plaza Food Hall, and a
                    comprehensive health and wellness center.",
                    "Unique Feature" => "The Plaza is home to the Eloise Suite, inspired by the fictional
                    young girl who lived at the hotel in the beloved children’s books. This whimsically decorated suite
                    offers a one-of-a-kind stay, complete with Eloise-themed books, toys, and a tea set."
                )
            )
        );
    }
}
