package caralert.com;

import java.util.ArrayList;
import java.util.Iterator;

public class car {
	public String CarColor;
	public String CarRegNo;
	public String  CarMakeModel;
	public String  IncDesc;
	public String  IncDate;

	car(){
		CarColor = "";
		CarRegNo = "";
		CarMakeModel = "";
		IncDesc = "";
		IncDate = "";
	}
	public String GetCarColor()
	{ 
		return CarColor;
	}
	public String GetCarRegNo()
	{ 
		return CarRegNo;
	}
	public String GetCarMakeModel()
	{ 
		return CarMakeModel;
	}
	public String GetIncDesc()
	{ 
		return IncDesc;
	}
	public String GetIncDate()
	{ 
		return IncDate;
	}
	public static void FilterByReg(ArrayList<car> c,String s)
	{
		for(Iterator<car> i = c.iterator(); i.hasNext();)
		{
			car temp = i.next();
			String temp_filter = temp.CarColor+temp.CarMakeModel+temp.CarRegNo+temp.IncDesc;
			if( temp_filter.toUpperCase().indexOf(s.toUpperCase()) < 0)
			{
				i.remove();
			}
		}
	}
	public void SetCarColor(String value) 
	{
		CarColor= value;
	}
	public void SetCarRegNo(String value) 
	{
		CarRegNo= value;
	}
	public void SetCarMakeModel(String value) 
	{
		CarMakeModel= value;
	}
	public void SetIncDesc(String value) 
	{
		IncDesc= value;
	}
	public void SetIncDate(String value) 
	{
		IncDate= value;
	}
}
