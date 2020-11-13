import { Component, OnInit, AfterViewInit } from '@angular/core';
import {Course} from "../course";
import {CourseService} from "../course.service";
import {ActivatedRoute} from "@angular/router";
import * as L from 'leaflet';
import 'leaflet-draw';
import { MatTableDataSource } from '@angular/material/table';


@Component({
  selector: 'app-manage-course',
  templateUrl: './manage-course.component.html',
  styleUrls: ['./manage-course.component.sass']
})
export class ManageCourseComponent implements OnInit, AfterViewInit {
  id: number;
  course: Course;
  private map;
  private courseMap;
  dataSource: MatTableDataSource<any>;
  labels = ["Hole", "Men's Par", "Ladies' Par", "Men's Handicap", "Ladies' Handicap"];
  dataColumns = [
    'hole_number',
    'par_men',
    'par_ladies',
    'handicap_men',
    'handicap_ladies'
  ];
  displayedColumns = [];
  holes = [
    {hole_number: 1,
      par_men: 5,
      par_ladies: 5,
      handicap_men: 11,
      handicap_ladies: 11,
      geo: [[-83.19740568812945, 42.67230473714778],[-83.1965688389168, 42.67230473714778],[-83.19896136935809, 42.668155355871036],[-83.19940125163653, 42.668336798486294],[-83.19941198047259, 42.66892056678555],[-83.19740568812945, 42.67230473714778]]},
    {hole_number: 2,
      par_men: 4,
      par_ladies: 5,
      handicap_men: 9,
      handicap_ladies: 9,
      geo: [[-83.19967153201934, 42.668436324149624],[-83.19992902408477, 42.66843632414958],[-83.20012214313384, 42.66827854824511],[-83.20060494075652, 42.66721355041483],[-83.20083024631377, 42.66570279811752],[-83.2005298389041, 42.664124951669734],[-83.20022943149444, 42.66405394763799],[-83.19995048175689, 42.664140730332434],[-83.19980669896445, 42.66743210797909],[-83.19967153201934, 42.668436324149624]]},
    {hole_number: 3,
      par_men: 3,
      par_ladies: 5,
      handicap_men: 17,
      handicap_ladies: 15,
      geo: [[-83.19960414848555, 42.663978053542984],[-83.20030152282942, 42.66399383224298],[-83.20158898315657, 42.66452241637854],[-83.2019001194023, 42.66448296995644],[-83.20202886543501, 42.66426995884459],[-83.20194303474653, 42.66402538963096],[-83.20046245537031, 42.663615142337875],[-83.19946467361677, 42.66372559379845],[-83.19960414848555, 42.663978053542984]]},
    {hole_number: 4,
      par_men: 4,
      par_ladies: 5,
      handicap_men: 13,
      handicap_ladies: 13,
      geo: [[-83.20265113792647, 42.66426206953013],[-83.202747697451, 42.663978053542984],[-83.2026940532707, 42.66381237695127],[-83.20250093422163, 42.66381237695127],[-83.20225417099226, 42.664009610938976],[-83.20098553192696, 42.66555784232994],[-83.20068512451729, 42.66673406197916],[-83.20109282028756, 42.66693128669748],[-83.20141468536934, 42.66693128669748],[-83.20162926209053, 42.66672617297742],[-83.20174727928719, 42.66596882414813],[-83.20212278854927, 42.66500070519499],[-83.20265113792647, 42.66426206953013]]},
    {hole_number: 5,
      par_men: 4,
      par_ladies: 5,
      handicap_men: 1,
      handicap_ladies: 5,
      geo: [[-83.20178654142025, 42.66684104367369],[-83.20177581258419, 42.66648603821484],[-83.20473697133663, 42.66620203238801],[-83.20645421747616, 42.66688837758172],[-83.20647567514828, 42.66733804791014],[-83.20592850450925, 42.66733015898503],[-83.20479124788693, 42.66689626656288],[-83.20178654142025, 42.66684104367369]]},
    {hole_number: 6,
      par_men: 5,
      par_ladies: 5,
      handicap_men: 3,
      handicap_ladies: 1,
      geo: [[-83.20608687476286, 42.668591306291454],[-83.20600104407438, 42.66827575486874],[-83.20217084960112, 42.668078534416054],[-83.20057225302824, 42.668409864419104],[-83.19951872513194, 42.669056741716005],[-83.19930414841075, 42.66948273040594],[-83.1998191325416, 42.66965628051668],[-83.20063452408213, 42.66918296089146],[-83.20253352806468, 42.668764858891144],[-83.20608687476286, 42.668591306291454]]},
    {hole_number: 7,
      par_men: 4,
      par_ladies: 5,
      handicap_men: 7,
      handicap_ladies: 7,
      geo: [[-83.19928057781699, 42.669653777682484],[-83.19910891644004, 42.67004820796612],[-83.2024348556185, 42.67034797330771],[-83.20325024715903, 42.67090016883668],[-83.20361502758506, 42.671334033310714],[-83.2040012656832, 42.671357698558545],[-83.20425875774863, 42.67116837632351],[-83.20382960430625, 42.670411081616464],[-83.2031000434542, 42.669803661485126],[-83.19928057781699, 42.669653777682484]]},
    {hole_number: 8,
      par_men: 3,
      par_ladies: 5,
      handicap_men: 15,
      handicap_ladies: 17,
      geo: [[-83.20424802891257, 42.67175352675355],[-83.20420511356834, 42.67147743339302],[-83.20170529476646, 42.67118556193549],[-83.2014263450289, 42.671351218876886],[-83.20152290455344, 42.671635201177786],[-83.20424802891257, 42.67175352675355]]},
    {hole_number: 9,
      par_men: 4,
      par_ladies: 5,
      handicap_men: 5,
      handicap_ladies: 3,
      geo: [[-83.20267089001182, 42.67056237234411],[-83.20241339794639, 42.67036515914655],[-83.20054658047202, 42.670294162242236],[-83.19931276432517, 42.67071225395574],[-83.19829352489951, 42.67167464306139],[-83.19828279606345, 42.67212427876549],[-83.1984544574404, 42.67225049171175],[-83.19886215321067, 42.67215583202607],[-83.19985993496421, 42.67120922723986],[-83.20066459766868, 42.670972573790635],[-83.20267089001182, 42.67056237234411]]},
    {hole_number: 10,
      par_men: 4,
      par_ladies: 5,
      handicap_men: 6,
      handicap_ladies: 8,
      geo: [[-83.19545274383121, 42.67239269257986],[-83.1955600321918, 42.670327324852074],[-83.19603210097843, 42.668828483189095],[-83.19648271209293, 42.6687653732735],[-83.19687967902713, 42.6690809222107],[-83.19647198325687, 42.67050876112729],[-83.1957515931647, 42.672433530738616],[-83.19545274383121, 42.67239269257986]]},
    {hole_number: 11,
      par_men: 4,
      par_ladies: 5,
      handicap_men: 16,
      handicap_ladies: 14,
      geo: [[-83.19752185111453, 42.66898906359645],[-83.19779007201602, 42.668807622885154],[-83.19742529159, 42.66732377510257],[-83.19666354422976, 42.66569074588643],[-83.19627730613162, 42.665603965355686],[-83.19601981406619, 42.66577752629601],[-83.19611637359073, 42.66670054679218],[-83.19713358033938, 42.66885910753128],[-83.19752185111453, 42.66898906359645]]},
    {hole_number: 12,
      par_men: 3,
      par_ladies: 5,
      handicap_men: 18,
      handicap_ladies: 18,
      geo: [[-83.19586606308779, 42.667218229709825],[-83.19623084351382, 42.66713145131142],[-83.19556565567812, 42.66507498842017],[-83.1952008752521, 42.66503554234867],[-83.19488973900637, 42.665256440026596],[-83.19586606308779, 42.667218229709825]]},
    {hole_number: 13,
      par_men: 4,
      par_ladies: 5,
      handicap_men: 2,
      handicap_ladies: 2,
      geo: [[-83.19578309020572, 42.66484135595096],[-83.19798250159793, 42.66358695390628],[-83.19931287726932, 42.66364217968617],[-83.2001926418262, 42.66344494453281],[-83.20004243812137, 42.66302181712038],[-83.19795031508976, 42.66292714338016],[-83.1971671100574, 42.66321905361611],[-83.19555614680326, 42.66463245300804],[-83.19578309020572, 42.66484135595096]]},
    {hole_number: 14,
      par_men: 4,
      par_ladies: 5,
      handicap_men: 10,
      handicap_ladies: 10,
      geo: [[-83.20035193652188, 42.66330263487357],[-83.20019100398099, 42.66282137737167],[-83.20051286906278, 42.66136969283253],[-83.20096348017728, 42.66072273554314],[-83.20221875399625, 42.66043870338719],[-83.20265863627469, 42.66058860940896],[-83.20276592463529, 42.66084108189184],[-83.20187543124234, 42.661085663632],[-83.20106003970182, 42.66205609137706],[-83.20035193652188, 42.66330263487357]]},
    {hole_number: 15,
      par_men: 3,
      par_ladies: 5,
      handicap_men: 14,
      handicap_ladies: 16,
      geo: [[-83.20258709358637, 42.661122486492026],[-83.20272656845515, 42.6615169709087],[-83.20367070602839, 42.66181677739146],[-83.2053658621258, 42.661856225505254],[-83.20546242165034, 42.66168265361735],[-83.20520492958491, 42.66137495680704],[-83.20258709358637, 42.661122486492026]]},
    {hole_number: 16,
      par_men: 5,
      par_ladies: 5,
      handicap_men: 8,
      handicap_ladies: 6,
      geo: [[-83.20689770527198, 42.6620610677135],[-83.20683333225563, 42.661840158681734],[-83.20396873302772, 42.661966392510294],[-83.20144745655372, 42.662542331100774],[-83.20071789570167, 42.66329183223608],[-83.20100757427528, 42.66377308609624],[-83.20129725284889, 42.66385986918276],[-83.20178005047157, 42.66359163016024],[-83.20197316952064, 42.66305514864316],[-83.20689770527198, 42.6620610677135]]},
    {hole_number: 17,
      par_men: 4,
      par_ladies: 5,
      handicap_men: 12,
      handicap_ladies: 12,
      geo: [[-83.19964181388235, 42.664244007383346],[-83.19954525435782, 42.66398365936905],[-83.19913755858755, 42.66392054453475],[-83.1989122530303, 42.66425978601586],[-83.1984079977355, 42.66512554416833],[-83.19776426757193, 42.66724770419205],[-83.19805394614554, 42.66739759379651],[-83.19868694747305, 42.6671609258348],[-83.19897662604666, 42.66610379793819],[-83.19964181388235, 42.664244007383346]]},
    {hole_number: 18,
      par_men: 5,
      par_ladies: 5,
      handicap_men: 4,
      handicap_ladies: 4,
      geo: [[-83.19837581122732, 42.667371574877144],[-83.19882642234182, 42.66730057455352],[-83.19876204932547, 42.66836557089284],[-83.19621931517935, 42.6725386029347],[-83.19587599242544, 42.6725386029347],[-83.19586526358938, 42.671931203595136],[-83.19664846862173, 42.67014234848462],[-83.19778572524405, 42.668832832286874],[-83.19827925170279, 42.66787039917928],[-83.19837581122732, 42.667371574877144]]}];


  constructor(private courseService: CourseService, private route: ActivatedRoute) {
    this.flipCoords();
    this.transpose();
    this.fillLabels();
  }

  ngOnInit(): void {
    this.route.params.subscribe(params => {
      this.id = +params.id;
    });
    this.courseService.getCourse(this.id)
      .subscribe(data => this.course = data);
  }

  ngAfterViewInit(): void {
    this.initMap();
    const tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });

    tiles.addTo(this.map);
    let i = 0;
    this.holes.forEach(hole => {
      L.polygon(hole.geo, {
        id: hole.hole_number,
        weight: 1,
        fillOpacity: 0.7,
        color: 'red',
        dashArray: '3'
      }).bindPopup("Hole "+hole.hole_number+"<br /><a (click)='editHole("+this.holes.indexOf(hole)+")'>Edit Details</a>").addTo(this.courseMap);
      i++;
    });
  }

  private initMap(): void {
    this.map = L.map('map', {
      center: [42.6730347, -83.196061],
      zoom: 15
    });
    this.courseMap = new L.FeatureGroup();
    this.map.addLayer(this.courseMap);
    var drawControl = new L.Control.Draw({
      draw: {
        polyline: false,
        rectangle: false,
        circle: false,
        marker: false,
        circlemarker: false
      },
      edit: {
        featureGroup: this.courseMap
      }
    });
    this.map.addControl(drawControl);

    this.map.on('draw:created', (e) => {
      var type = e.layerType,
        layer = e.layer;
      if (type === 'marker') {
        // Do marker specific actions
      }
      // Do whatever else you need to. (save to db; add to map etc)
      this.courseMap.addLayer(layer);
    });

    this.map.on('draw:edited', (e) => {
      var layers = e.layers;
      layers.eachLayer((layer) => {
        //do whatever you want; most likely save back to db
        const i = this.holes.findIndex(h => h.hole_number === layer.options.id);
        this.holes[i].geo = layer.getLatLngs();
        console.log("Hole "+layer.options.id+" updated: "+this.holes[i].geo.toString());
      });
    });
  }

  private flipCoords(): void {
    for(let i = 0; i < this.holes.length; i++) {
      let poly = [];
      for(let n = 0; n < this.holes[i].geo.length; n++) {
        poly.push([this.holes[i].geo[n][1],this.holes[i].geo[n][0]]);
      }
      this.holes[i].geo = poly;
    }
  }

  transpose() {
    let transposedData = [];
    for (let column = 0; column < this.dataColumns.length; column++) {
      let tee = -1;
      let lbl = this.labels[column];
      transposedData[column] = {
        label: lbl
      };
      for (let row = 0; row < this.holes.length; row++) {
        transposedData[column][`column${row}`] = this.holes[row][this.dataColumns[column]];
      }
    }
    this.dataSource = new MatTableDataSource(transposedData);
  }

  fillLabels() {
    this.displayedColumns = ['label'];
    for (let i = 0; i < this.holes.length; i++) {
      this.displayedColumns.push('column' + i);
    }
  }

}
