package caralert.com;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.DataInputStream;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.Writer;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.content.ContextWrapper;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.ParseException;
import android.os.Bundle;
import android.os.StrictMode;
import android.preference.PreferenceManager;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.AutoCompleteTextView;
import android.widget.ListView;


public class CaralertActivity extends Activity {
    /** Called when the activity is first created. */
	static String FILENAME = "local_json";
	ListView myList;
	AlertsAdapter arrayAdapter;
	ArrayList<car> cars=null;
	private SharedPreferences preferences;
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.main);
        preferences = PreferenceManager.getDefaultSharedPreferences(this);
        
        StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder().permitAll().build();
        StrictMode.setThreadPolicy(policy);
        
         myList= (ListView)findViewById(R.id.listView1);
        
        cars = new ArrayList<car>();
        
        arrayAdapter = new AlertsAdapter(this, R.layout.list_item,cars);
        myList.setAdapter(arrayAdapter);
        
        myList.setOnItemClickListener(new OnItemClickListener() {
        	public void onItemClick(AdapterView<?> parent,
    		        View view, int pos, long id)  {
        		ShowCarDetails.set_item_clicked(cars.get(pos));
        		Intent intent = new Intent(CaralertActivity.this, ShowCarDetails.class);
		        startActivityForResult(intent,0);
			}
		});
        
        sync();
        try {
			LoadCars(cars);
		} catch (JSONException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}
        /*
        try {
			LoadCars(cars);
		} catch (org.json.simple.parser.ParseException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}*/
        
        
        AutoCompleteTextView textView = (AutoCompleteTextView)
                findViewById(R.id.autoCompleteTextViewReg);
        textView.addTextChangedListener(new TextWatcher() {
			public void onTextChanged(CharSequence s, int start, int before, int count) {
				// TODO Auto-generated method stub
				//Filter the listview items
				cars.clear();
				//extracted();
				try {
					LoadCars(cars);
				} catch (JSONException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				if(!s.toString().isEmpty())
				car.FilterByReg(cars, s.toString());
				arrayAdapter.notifyDataSetChanged();
			}
			
			public void beforeTextChanged(CharSequence s, int start, int count,
					int after) {
				// TODO Auto-generated method stub
				
			}
			
			public void afterTextChanged(Editable s) {
				// TODO Auto-generated method stub
				
			}
		});
    }
	private void extracted() {
		car test = new car();
        test.CarColor = "BLACK";
        test.CarMakeModel = "BMW";
        test.CarRegNo = "VOKONA GP";
        
        cars.add(test);
        
        car test2 = new car();
        test2.CarColor = "BLACK";
        test2.CarMakeModel = "BMW";
        test2.CarRegNo = "WXP 123 GP";
        
        cars.add(test2);
	}
	private void LoadCars(ArrayList<car> cars) throws JSONException 
	{		 
		ContextWrapper cw = new ContextWrapper(getApplicationContext());
		File directory = cw.getDir("media", getApplicationContext().MODE_PRIVATE);
		try {
					
			FileReader rdr = new FileReader(directory+"/"+CaralertActivity.FILENAME);
			StringBuffer buf = new StringBuffer();
			BufferedReader bufRdr = new BufferedReader(rdr);
			String line;
			while((line = bufRdr.readLine())!= null){
				buf.append(line);
			}
			JSONArray arr = new JSONArray(buf.toString());
			for(int i=0;i<arr.length(); i++){
			   JSONObject obj = arr.getJSONObject(i);
			   
			   car var = new car();
				var.CarRegNo =	obj.getString("CarRegNo");
				var.CarColor = obj.getString("CarColor");
				var.CarMakeModel = obj.getString("CarMakeModel");
				var.IncDate = obj.getString("IncDate");
				var.IncDesc = obj.getString("IncDesc");
				
				cars.add(var);	
			}
	 
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		} catch (ParseException e) {
			e.printStackTrace();
		}	
}
	private void sync()
	{
		ContextWrapper cw = new ContextWrapper(getApplicationContext());
		File directory = cw.getDir("media", getApplicationContext().MODE_PRIVATE);
		//directory+"/"+CaralertActivity.FILENAME
		try {
			URL url = new URL(preferences.getString("URL", ""));
			HttpURLConnection c = (HttpURLConnection) url.openConnection();
            c.setRequestMethod("GET");
            c.setDoOutput(true);
            c.connect();
            
            InputStream is = c.getInputStream();
            
            DataInputStream in = new DataInputStream(is);
            BufferedReader br = new BufferedReader(new InputStreamReader(in));
            String str;
            Writer output = null;
            File file = new File(directory+"/"+CaralertActivity.FILENAME);
            output = new BufferedWriter(new FileWriter(file));
            
            
            while ((str = br.readLine()) != null) {
              //System.out.println(str);
            	output.write(str);
            }
            output.close();
            
            
            
		} catch (MalformedURLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		
	}
	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		super.onCreateOptionsMenu(menu);
		MenuInflater inflater = getMenuInflater();
		inflater.inflate(R.menu.menu, menu);
		return true;
	}
	@Override
	public boolean onOptionsItemSelected(MenuItem item) {
		if (item.getItemId() == R.id.settings) {
			startActivity(new Intent(this, PreferencesActivity.class));
			return true;
		}
		return false;
	}
}