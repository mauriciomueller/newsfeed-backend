<?php

namespace Database\Seeders;

use App\Models\SettingsSource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sources = SettingsSource::insert([
            [
                "code"=> "abc-news",
                "name"=> "ABC News",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "al-jazeera-english",
                "name"=> "Al Jazeera English",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "ars-technica",
                "name"=> "Ars Technica",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "associated-press",
                "name"=> "Associated Press",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "axios",
                "name"=> "Axios",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "bleacher-report",
                "name"=> "Bleacher Report",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "bloomberg",
                "name"=> "Bloomberg",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "breitbart-news",
                "name"=> "Breitbart News",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "business-insider",
                "name"=> "Business Insider",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "buzzfeed",
                "name"=> "Buzzfeed",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "cbs-news",
                "name"=> "CBS News",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "cnn",
                "name"=> "CNN",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "cnn-es",
                "name"=> "CNN Spanish",
                "language"=> "es",
                "country"=> "us"
            ],[
                "code"=> "crypto-coins-news",
                "name"=> "Crypto Coins News",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "engadget",
                "name"=> "Engadget",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "entertainment-weekly",
                "name"=> "Entertainment Weekly",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "espn",
                "name"=> "ESPN",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "espn-cric-info",
                "name"=> "ESPN Cric Info",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "fortune",
                "name"=> "Fortune",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "fox-news",
                "name"=> "Fox News",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "fox-sports",
                "name"=> "Fox Sports",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "google-news",
                "name"=> "Google News",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "hacker-news",
                "name"=> "Hacker News",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "ign",
                "name"=> "IGN",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "mashable",
                "name"=> "Mashable",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "medical-news-today",
                "name"=> "Medical News Today",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "msnbc",
                "name"=> "MSNBC",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "mtv-news",
                "name"=> "MTV News",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "national-geographic",
                "name"=> "National Geographic",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "national-review",
                "name"=> "National Review",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "nbc-news",
                "name"=> "NBC News",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "new-scientist",
                "name"=> "New Scientist",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "newsweek",
                "name"=> "Newsweek",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "new-york-magazine",
                "name"=> "New York Magazine",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "next-big-future",
                "name"=> "Next Big Future",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "nfl-news",
                "name"=> "NFL News",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "nhl-news",
                "name"=> "NHL News",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "politico",
                "name"=> "Politico",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "polygon",
                "name"=> "Polygon",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "recode",
                "name"=> "Recode",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "reddit-r-all",
                "name"=> "Reddit /r/all",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "reuters",
                "name"=> "Reuters",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "techcrunch",
                "name"=> "TechCrunch",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "techradar",
                "name"=> "TechRadar",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "the-american-conservative",
                "name"=> "The American Conservative",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "the-hill",
                "name"=> "The Hill",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "the-huffington-post",
                "name"=> "The Huffington Post",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "the-next-web",
                "name"=> "The Next Web",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "the-verge",
                "name"=> "The Verge",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "the-wall-street-journal",
                "name"=> "The Wall Street Journal",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "the-washington-post",
                "name"=> "The Washington Post",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "the-washington-times",
                "name"=> "The Washington Times",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "time",
                "name"=> "Time",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "usa-today",
                "name"=> "USA Today",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "vice-news",
                "name"=> "Vice News",
                "language"=> "en",
                "country"=> "us"
            ],[
                "code"=> "wired",
                "name"=> "Wired",
                "language"=> "en",
                "country"=> "us"
            ]
        ]);
    }
}
