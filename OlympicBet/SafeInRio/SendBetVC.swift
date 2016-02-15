//
//  SendBetVC.swift
//  OlympicBet
//
//  Created by Amanda Aurita Araujo Fernandes on 12/12/15.
//  Copyright © 2015 Amanda Aurita Araujo Fernandes. All rights reserved.
//

import UIKit

class SendBetVC: UIViewController {
    
    
    //-----Labels
    var sportLbl: UILabel!
    var dateLbl: UILabel!
    var team1Lbl: UILabel!
    var team2Lbl: UILabel!
    var xLabel: UILabel!
    
    //-----Image Views
    var team1: UIImageView!
    var team2: UIImageView!
    
    //-----TextFields
    var result1:UITextField!
    var result2: UITextField!
    
    //-----Buttons
    var sendBtn: UIButton!
    var backBtn: UIButton!
    

    override func viewDidLoad() {
        super.viewDidLoad()
        
        //-------View
        self.view.backgroundColor = UIColor.azulBebe()
        let screenSize: CGRect = UIScreen.mainScreen().bounds
        let screenWidth = screenSize.width
        let screenHeight = screenSize.height
        
        //-------Labels
        xLabel = UILabel(frame: CGRectMake(150, 160, 16, 16))
        xLabel.text = "x"
        self.view.addSubview(xLabel)
        
        sportLbl = UILabel(frame: CGRectMake(50,50,200,40))
//        sportLbl.center.x = self.view.center.x
        sportLbl.font = UIFont(name: "Helvetica", size: 20)
        sportLbl.textColor = UIColor.whiteColor()
        sportLbl.textAlignment = .Center
        sportLbl.numberOfLines = 1
        sportLbl.text = SystemStatus.sharedInstance.currentGame.modality
        self.view.addSubview(sportLbl)
        
        //-------Images
        let team1 = UIImageView(frame: CGRectMake(10, 100, 128, 128))
        team1.image = UIImage(named: "128_\(SystemStatus.sharedInstance.currentGame.participant[0].country_code as String!)")
        self.view.addSubview(team1)
        
        let team2 = UIImageView(frame: CGRectMake(180, 100, 128, 128))
        team2.image = UIImage(named: "128_\(SystemStatus.sharedInstance.currentGame.participant[1].country_code as String!)")
        self.view.addSubview(team2)
        
        //-------Buttons
        let backBtn = UIButton()
        backBtn.frame = CGRectMake(0, 30, 60,20)
        backBtn.setTitle("<Back", forState: .Normal)
        backBtn.setTitleColor(UIColor.amarelo(), forState: .Normal)
//        backBtn.center.x = self.view.center.x
        backBtn.backgroundColor = UIColor.clearColor()
        backBtn.addTarget(self, action: "back", forControlEvents: UIControlEvents.TouchUpInside)
        self.view.addSubview(backBtn)
        
        let betBtn = UIButton()
        betBtn.frame = CGRectMake(20,400, self.view.frame.width - 40, 100)
        betBtn.setTitle("Send Bet!", forState: .Normal)
        betBtn.setTitleColor(UIColor.azulClaro(), forState: .Normal)
        betBtn.layer.cornerRadius = 10
        //        backBtn.center.x = self.view.center.x
        betBtn.backgroundColor = UIColor.amarelo()
        betBtn.addTarget(self, action: "betNow", forControlEvents: UIControlEvents.TouchUpInside)
        self.view.addSubview(betBtn)
        
        //-------TextFields
        result1 = UITextField(frame: CGRectMake(55,250,45,30))
        result1.backgroundColor = UIColor.whiteColor()
        result1.textColor = UIColor.verde()
        result1.font = UIFont(name: "Helvetica", size: 30)
        result1.keyboardType = UIKeyboardType.PhonePad
        self.view.addSubview(result1)
        
        result2 = UITextField(frame: CGRectMake(225,250,45,30))
        result2.backgroundColor = UIColor.whiteColor()
        result2.textColor = UIColor.verde()
        result2.font = UIFont(name: "Helvetica", size: 30)
        result2.keyboardType = UIKeyboardType.PhonePad
        self.view.addSubview(result2)
        

        // Do any additional setup after loading the view.
    }
    
    override func touchesBegan(touches: Set<UITouch>, withEvent event: UIEvent?) {
        
        for touch in touches{
            let point = touch.locationInView(self.view)
            if(point.y < 250 ){
                self.result1.resignFirstResponder()
                self.result2.resignFirstResponder()
            }
        }
    }
    
    func betNow(){
        var idparticipant = 0
        print(result1.text!)
        if result1.text == ""{
            idparticipant = SystemStatus.sharedInstance.currentGame.participant[1].id!
        }else if result2.text == ""{
            idparticipant = SystemStatus.sharedInstance.currentGame.participant[0].id!
        }else if Int(result1.text!) < Int(result2.text!){
            idparticipant = SystemStatus.sharedInstance.currentGame.participant[1].id!
        }else{
            idparticipant = SystemStatus.sharedInstance.currentGame.participant[0].id!
        }
        
        
        DAO().sendBet(result1.text!, result2: result2.text!, participantId: idparticipant)
    }
    
    func back(){
        print("entrou")
        self.dismissViewControllerAnimated(false, completion: nil)
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    

    /*
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepareForSegue(segue: UIStoryboardSegue, sender: AnyObject?) {
        // Get the new view controller using segue.destinationViewController.
        // Pass the selected object to the new view controller.
    }
    */

}
