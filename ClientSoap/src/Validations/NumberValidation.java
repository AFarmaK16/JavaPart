package Validations;

import java.util.regex.Pattern;

public class NumberValidation {
        public static boolean isValid(String phoneNumber) {
        String phoneNumberRegex = "^(221|00221)?(77|78|75|70|76)[0-9]{7}$";
        Pattern pat = Pattern.compile(phoneNumberRegex);
        if (phoneNumber == null)
            return false;
        return pat.matcher(phoneNumber).matches();
    }
}
