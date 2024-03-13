<?php

namespace Hunor\WebtCoreViewsInMvc;

class HotelInformationProvider
{
    static function getHotels(): array
    {
        return array(
            "hotels" => array(
                array(
                    "name" => "The Plaza Hotel",
                    "location" => "Location: New York City, USA",
                    "information" => array(
                        array(
                            "topic" => "Overview",
                            "text" => "An iconic landmark located at the prestigious corner of Fifth Avenue and Central Park South, The
                    Plaza Hotel is synonymous with timeless elegance and luxury. Since its opening in 1907, it has been
                    a popular choice for celebrities, royalty, and discerning travelers. The hotel's opulent interiors,
                    adorned with Beaux-Arts décor, and its impeccable white-glove service make it a quintessential New
                    York experience."
                        ),
                        array(
                            "topic" => "Amenities",
                            "text" => "The Plaza offers the grandeur of old-world elegance with the comforts
                        of modern amenities, including luxurious rooms and suites, the famous Palm Court for afternoon tea,
                        several high-end dining options, a lavish Champagne Bar, the renowned Plaza Food Hall, and a
                        comprehensive health and wellness center."
                        ),
                        array(
                            "topic" => "Unique Feature",
                            "text" => "The Plaza is home to the Eloise Suite, inspired by the fictional
                        young girl who lived at the hotel in the beloved children’s books. This whimsically decorated suite
                        offers a one-of-a-kind stay, complete with Eloise-themed books, toys, and a tea set."
                        )
                    )
                ),
                array(
                    "name" => "Burj Al Arab Jumeirah",
                    "location" => "Location: Dubai, United Arab Emirates",
                    "information" => array(
                        array(
                            "topic" => "Overview",
                            "text" => "Standing on its own artificial island and designed to resemble the
                        sail of a ship, the Burj Al Arab Jumeirah is often recognized as one of the most luxurious hotels in
                        the world. This all-suite hotel soars to a height of 321 meters, dominating the Dubai skyline with
                        its distinctive silhouette. Offering unparalleled standards of comfort and service, the Burj Al Arab
                        is a symbol of modern Dubai’s luxury and opulence."
                        ),
                        array(
                            "topic" => "Amenities",
                            "text" => "The hotel boasts suites with stunning views, personal butler service,
                        nine world-class restaurants and bars, two swimming pools, a private beach, and the Talise Spa. Each
                        suite is a duplex with floor-to-ceiling windows, offering breathtaking views of the Arabian Gulf."
                        ),
                        array(
                            "topic" => "Unique Feature",
                            "text" => "The Burj Al Arab offers an unforgettable arrival experience by options of a chauffeur-driven
                        Rolls-Royce, helicopter, and a private jet service. The hotel also features the Skyview Bar,
                        suspended 200 meters above sea level, providing guests with spectacular panoramic views of the city
                        and the gulf."
                        )
                    )
                ),
                array(
                    "name" => "The Plaza Hotel",
                    "location" => "Location: New York City, USA",
                    "information" => array(
                        array(
                            "topic" => "Overview",
                            "text" => "An iconic landmark located at the prestigious corner of Fifth Avenue and Central Park South, The
                        Plaza Hotel is synonymous with timeless elegance and luxury. Since its opening in 1907, it has been
                        a popular choice for celebrities, royalty, and discerning travelers. The hotel's opulent interiors,
                        adorned with Beaux-Arts décor, and its impeccable white-glove service make it a quintessential New
                        York experience."
                        ),
                        array(
                            "topic" => "Amenities",
                            "text" => "The Plaza offers the grandeur of old-world elegance with the comforts
                        of modern amenities, including luxurious rooms and suites, the famous Palm Court for afternoon tea,
                        several high-end dining options, a lavish Champagne Bar, the renowned Plaza Food Hall, and a
                        comprehensive health and wellness center."
                        ),
                        array(
                            "topic" => "Unique Feature",
                            "text" => "The Plaza is home to the Eloise Suite, inspired by the fictional
                        young girl who lived at the hotel in the beloved children’s books. This whimsically decorated suite
                        offers a one-of-a-kind stay, complete with Eloise-themed books, toys, and a tea set."
                        )
                    )
                )
            )
        );
    }
}
