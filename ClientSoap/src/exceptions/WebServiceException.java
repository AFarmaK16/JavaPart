package exceptions;

public class WebServiceException extends Exception{
    public WebServiceException(String errorString) {
        super(errorString);
    }
}
