package caralert.com;

import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.Uri;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.TextView;

public class ShowCarDetails extends Activity {
	public static car incar = new car();

	public static void set_item_clicked(car value) {
		incar = value;
	}

	private SharedPreferences preferences;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.details);
		preferences = PreferenceManager.getDefaultSharedPreferences(this);

		TextView reg = (TextView) findViewById(R.id.textViewRegistration);
		TextView make = (TextView) findViewById(R.id.textViewMaker);
		TextView color = (TextView) findViewById(R.id.textViewColor);
		TextView desc = (TextView) findViewById(R.id.textViewDesc);
		// Assign the appropriate data from our alert object above
		reg.setText(incar.CarRegNo);
		make.setText(incar.CarMakeModel);
		color.setText(incar.CarColor);
		desc.setText(incar.IncDesc);

		Button btn_back = (Button) findViewById(R.id.buttonBack);
		btn_back.setOnClickListener(new OnClickListener() {

			public void onClick(View arg0) {
				// TODO Auto-generated method stub
				Intent intent = new Intent();
				setResult(RESULT_OK, intent);
				finish();
			}
		});

		Button cal = (Button) findViewById(R.id.buttonCall);
		cal.setOnClickListener(new OnClickListener() {

			public void onClick(View arg0) {
				// TODO Auto-generated method stub
				Uri number = Uri.parse("tel:"+ preferences.getString("PHONE_NO", ""));
				Intent intent = new Intent(Intent.ACTION_CALL,number);
				intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
				startActivity(intent); 
			}
		});

	}
}
