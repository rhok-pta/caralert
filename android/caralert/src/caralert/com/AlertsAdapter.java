package caralert.com;
import java.util.List;

import caralert.com.R.string;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.LinearLayout;
import android.widget.TextView;

public class AlertsAdapter  extends ArrayAdapter<car>{
	int resource;
    String response;
    android.content.Context context;
    List<car> data = null; 
    
	public AlertsAdapter(android.content.Context context, int resource, List<car> items) {
        super(context, resource, items);
        this.resource=resource;
        this.data = items;
	}
	@Override
	public int getCount() {
		// TODO Auto-generated method stub
		return data.size();
	}
	@Override
	public car getItem(int arg0) {
		// TODO Auto-generated method stub
		return data.get(arg0);
	}
	@Override
	public long getItemId(int arg0) {
		// TODO Auto-generated method stub
		return arg0;
	}
	@Override
    public View getView(int position, View convertView, ViewGroup parent)
    {
        LinearLayout carView;
        //Get the current alert object
        car al = getItem(position);
 
        //Inflate the view
        if(convertView==null)
        {
        	carView = new LinearLayout(getContext());
            String inflater = android.content.Context.LAYOUT_INFLATER_SERVICE;
            LayoutInflater vi;
            vi = (LayoutInflater)getContext().getSystemService(inflater);
            vi.inflate(resource, carView, true);
        }
        else
        {
        	carView = (LinearLayout) convertView;
        }
        //Get the text boxes from the listitem.xml file
        TextView reg =(TextView)carView.findViewById(R.id.txtReg);
        TextView make =(TextView)carView.findViewById(R.id.txtMake);
        TextView color =(TextView)carView.findViewById(R.id.txtColor);
 
        //Assign the appropriate data from our alert object above
        reg.setText("Registration No. :  "+al.CarRegNo);
        make.setText("Car Make              :  "+al.CarMakeModel);
        color.setText("Car Color              :  "+al.CarColor);
        
        return carView;
    }
}

/*
public class AlertsAdapter  extends BaseAdapter{

	private String Reg_no;
	private String Make;
	private String Color;
	
    public AlertsAdapter(car mycar){
    	this.Reg_no = mycar._CarRegNo;
    	this.Make = mycar._CarMakeModel;
    	this.Color= mycar._CarColor; 
    }
	public int getCount() {
		// TODO Auto-generated method stub
		return 0;
	}

	public Object getItem(int arg0) {
		// TODO Auto-generated method stub
		return null;
	}

	public long getItemId(int arg0) {
		// TODO Auto-generated method stub
		return 0;
	}

	public View getView(int arg0, View arg1, ViewGroup arg2) {
		// TODO Auto-generated method stub
		return null;
	}

}
*/