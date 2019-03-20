<?php

namespace App\Http\Controllers;


use App\Message;
use App\Sensor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class MessageController extends Controller
{

    public function index(Request $request)
    {
        $this->validate($request, [
            'sensor' => 'nullable|exists:sensors,id',
            'command' => 'nullable|exists:messages,command'
        ]);
        $sensor = Sensor::find($request->sensor);
        $sensors = Sensor::all();
       // dd($request->toArray());


        $messages = new Message();
        if($request->exists('sensor') && $request->sensor != null)
        {
            $messages = $messages->where('node_address', $sensor->node_address);
        }
        if ($request->exists('command') && $request->command != null)
        {
            $messages = $messages->where('command', $request->command);
        }
        if ($request->exists('type') && $request->type != null)
        {
            $messages = $messages->where('type', $request->type);
        }
        if ($request->exists('dateL') && $request->dateL != null)
        {
            $date_to = Carbon::createFromFormat('d/m/Y H:i', $request->dateL);
            $dateN = Carbon:: createFromFormat('d/m/Y H:i', $request->dateN);
            $messages = $messages->wherebetween('created_at',array($date_to, $dateN));
        }

        $messages = $messages->orderBy('created_at', 'desc')->paginate(50);
        $tab_commands = [
            0 => 'Presentation',
            1 => 'Set',
            2 => 'Req',
            3 => 'Internal',
            4 => 'Stream',
        ];

        $tab_types = [
            0 => 'V_TEMP',	// Temperature  (S_TEMP, S_HEATER, S_HVAC)
            1 => 'V_HUM',	// Humidity (S_HUM)
            2 => 'V_STATUS',	// Binary status. 0=off 1=on (S_LIGHT, S_DIMMER, S_SPRINKLER, S_HVAC, S_HEATER)
            3 => 'V_PERCENTAGE',	// Percentage value. 0-100 (%) (S_DIMMER)
            4 => 'V_PRESSURE',	// Atmospheric Pressure (S_BARO)
            5 => 'V_FORECAST',	// Whether forecast. One of "stable", "sunny", "cloudy", "unstable", "thunderstorm" or "unknown" (S_BARO)
            6 => 'V_RAIN',	// Amount of rain (S_RAIN)
            7 => 'V_RAINRATE',	// Rate of rain (S_RAIN)
            8 => 'V_WIND',	// Windspeed (S_WIND)
            9 => 'V_GUST',	// Gust (S_WIND)
            10 => 'V_DIRECTION',	// Wind direction (S_WIND)
            11 => 'V_UV',	// UV light level (S_UV)
            12 => 'V_WEIGHT',	// Weight (for scales etc) (S_WEIGHT)
            13 => 'V_DISTANCE',	// Distance (S_DISTANCE)
            14 => 'V_IMPEDANCE',	// Impedance value (S_MULTIMETER, S_WEIGHT)
            15 => 'V_ARMED',	// Armed status of a security sensor. 1=Armed, 0=Bypassed (S_DOOR, S_MOTION, S_SMOKE, S_SPRINKLER, S_WATER_LEAK, S_SOUND, S_VIBRATION, S_MOISTURE)
            16 => 'V_TRIPPED',	// Tripped status of a security sensor. 1=Tripped, 0=Untripped (S_DOOR, S_MOTION, S_SMOKE, S_SPRINKLER, S_WATER_LEAK, S_SOUND, S_VIBRATION, S_MOISTURE)
            17 => 'V_WATT',	// Watt value for power meters (S_POWER, S_LIGHT, S_DIMMER, S_RGB, S_RGBW)
            18 => 'V_KWH',	// Accumulated number of KWH for a power meter (S_POWER)
            19 => 'V_SCENE_ON',	// Turn on a scene (S_SCENE_CONTROLLER)
            20 => 'V_SCENE_OFF',	// Turn of a scene (S_SCENE_CONTROLLER)
            21 => 'V_HVAC_FLOW_STATE',	// Mode of header. One of "Off", "HeatOn", "CoolOn", or "AutoChangeOver" (S_HVAC, S_HEATER)
            22 => 'V_HVAC_SPEED',	// HVAC/Heater fan speed ("Min", "Normal", "Max", "Auto") (S_HVAC, S_HEATER)
            23 => 'V_LIGHT_LEVEL',	// Uncalibrated light level. 0-100%. Use V_LEVEL for light level in lux. (S_LIGHT_LEVEL)
            24 => 'V_VAR1',	// Custom value (Any device)
            25 => 'V_VAR2',	// Custom value (Any device)
            26 => 'V_VAR3',	// Custom value (Any device)
            27 => 'V_VAR4',	// Custom value (Any device)
            28 => 'V_VAR5',	// Custom value (Any device)
            29 => 'V_UP',	// Window covering. Up. (S_COVER)
            30 => 'V_DOWN',	// Window covering. Down. (S_COVER)
            31 => 'V_STOP',	// Window covering. Stop. (S_COVER)
            32 => 'V_IR_SEND',	// Send out an IR-command (S_IR)
            33 => 'V_IR_RECEIVE',	// This message contains a received IR-command (S_IR)
            34 => 'V_FLOW',	// Flow of water (in meter) (S_WATER)
            35 => 'V_VOLUME',	// Water volume (S_WATER)
            36 => 'V_LOCK_STATUS',	// Set or get lock status. 1=Locked, 0=Unlocked (S_LOCK)
            37 => 'V_LEVEL',	// Used for sending level-value (S_DUST, S_AIR_QUALITY, S_SOUND (dB), S_VIBRATION (hz), S_LIGHT_LEVEL (lux))
            38 => 'V_VOLTAGE',	// Voltage level (S_MULTIMETER)
            39 => 'V_CURRENT',	// Current level (S_MULTIMETER)
            40 => 'V_RGB',	// RGB value transmitted as ASCII hex string (I.e "ff0000" for red) (S_RGB_LIGHT, S_COLOR_SENSOR)
            41 => 'V_RGBW',	// RGBW value transmitted as ASCII hex string (I.e "ff0000ff" for red + full white) (S_RGBW_LIGHT)
            42 => 'V_ID',	// Optional unique sensor id (e.g. OneWire DS1820b ids) (S_TEMP)
            43 => 'V_UNIT_PREFIX',	// Allows sensors to send in a string representing the unit prefix to be displayed in GUI. This is not parsed by controller! E.g. cm, m, km, inch. (S_DISTANCE, S_DUST, S_AIR_QUALITY)
            44 => 'V_HVAC_SETPOINT_COOL',	// HVAC cold setpoint (S_HVAC)
            45 => 'V_HVAC_SETPOINT_HEAT',	// HVAC/Heater setpoint (S_HVAC, S_HEATER)
            46 => 'V_HVAC_FLOW_MODE',	// Flow mode for HVAC ("Auto", "ContinuousOn", "PeriodicOn") (S_HVAC)
            47 => 'V_TEXT',	// S_INFO. Text message to display on LCD or controller device
            48 => 'V_CUSTOM',	// Custom messages used for controller/inter node specific commands, preferably using S_CUSTOM device type.
            49 => 'V_POSITION',	// GPS position and altitude. Payload: latitude;longitude;altitude(m). E.g. "55.722526;13.017972;18"
            50 => 'V_IR_RECORD',	// Record IR codes S_IR for playback
            51 => 'V_PH',	// S_WATER_QUALITY, water PH
            52 => 'V_ORP',	// S_WATER_QUALITY, water ORP : redox potential in mV
            53 => 'V_EC',	// S_WATER_QUALITY, water electric conductivity μS/cm (microSiemens/cm)
        ];


        return view('message.index')->with([
            'messages' => $messages->appends(Input::except('page')),
            'sensors'=>$sensors,
            'command' => $request->command,
            'sensor' => $request->sensor,
            'type' => $request->type,
            'tab_commands' => $tab_commands,
            'tab_types' => $tab_types,


        ]);

    }
}
