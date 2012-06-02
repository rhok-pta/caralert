package caralert.com;

import android.app.Activity;
import android.os.Bundle;
import android.widget.ArrayAdapter;
import android.widget.AutoCompleteTextView;

public class CaralertActivity extends Activity {
    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.main);
        
        ArrayAdapter<String> Reg_adapter = new ArrayAdapter<String>(this,
                android.R.layout.simple_dropdown_item_1line, GetRegistration());
        
        AutoCompleteTextView textView = (AutoCompleteTextView)
                findViewById(R.id.autoCompleteTextViewReg);
        textView.setAdapter(Reg_adapter);
    }
    
    private String[] GetRegistration() {
        //Pull registration from local base
    	
    	//Placeholder testing
    	return new String[] { "XVH 123 GP", "BZZ 432 MP", "HHT 123 L"} ;
    };
}