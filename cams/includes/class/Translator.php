<?php
    
    abstract class Languages{
        const string ES = "ES"
        const string EN = "EN"
    }

    public static class Translator{
        private string systemLanguage = Languages::EN
        private string translationFile = "../translations/en"

        public static changeLanguage(string language){
            this->sytemLanguage = language
        }
    }
?>