//
//  GameViewController.swift
//  SafeInRio
//
//  Created by Amanda Aurita Araujo Fernandes on 12/12/15.
//  Copyright © 2015 Amanda Aurita Araujo Fernandes. All rights reserved.
//

import UIKit

class GameViewController: UIViewController, UITableViewDataSource, UITableViewDelegate{
    
    
    
    //-----Table View------
    var tableView : UITableView!
    
    //-----Células---------
    var betCell : GameCell!
    
    //------Label----------
    var titleLbl : UILabel!
   
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        
        //--------View
        let bounds = UIScreen.mainScreen().bounds
        let width = bounds.size.width
        let height = bounds.size.height
        self.view.backgroundColor = UIColor.whiteColor()

        
        //--------Table View --------
        self.tableView = UITableView(frame: CGRectMake(0, 50, width, height * 4/5))
        self.tableView.backgroundColor = UIColor.amarelo()
        self.tableView.center.x = self.view.center.x
        self.tableView.delegate = self
        self.tableView.dataSource = self
        self.tableView.scrollEnabled = true
        self.tableView.allowsSelection = true
        self.tableView.separatorStyle = .None
        self.tableView.registerClass(GameCell.self, forCellReuseIdentifier: "GameCell")
        self.view.addSubview(self.tableView)
        
        
        //--------Title Label  --------
        self.titleLbl = UILabel()
        titleLbl.frame = CGRect(x: 0, y: 0, width: width, height: 55)
        titleLbl.text = "Upcoming Games"
        titleLbl.textColor = UIColor.azulClaro()
        titleLbl.textAlignment = .Center
        titleLbl.font = UIFont(name: titleLbl.font.fontName, size: 20)
        self.view.addSubview(titleLbl)

        
    }
    
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        
    }
    
    //MARK: Funções do delegate e datasource da TableView
    func numberOfSectionsInTableView(tableView: UITableView) -> Int
    {
        return 1
    }
    
    func tableView(tableView: UITableView, numberOfRowsInSection section: Int) -> Int
    {
        return SystemStatus.sharedInstance.games.count
    }
    
    func tableView(tableView: UITableView, heightForRowAtIndexPath indexPath: NSIndexPath) -> CGFloat {
        return 100
    }
    
    func tableView(tableView: UITableView, cellForRowAtIndexPath indexPath: NSIndexPath) -> UITableViewCell
    {
        betCell = tableView.dequeueReusableCellWithIdentifier("GameCell", forIndexPath: indexPath) as! GameCell
        betCell.selectionStyle = .Gray
        betCell.sportLbl.text = SystemStatus.sharedInstance.games[indexPath.row].modality
        
        betCell.team1.image = UIImage(named:"48_\(SystemStatus.sharedInstance.games[indexPath.row].participant[0].country_code as String!)")
        betCell.team2.image = UIImage(named:"48_\(SystemStatus.sharedInstance.games[indexPath.row].participant[1].country_code as String!)")
        betCell.time.text = SystemStatus.sharedInstance.nsdate2string(SystemStatus.sharedInstance.games[indexPath.row].time!)
        return betCell
    }
    
    
    func tableView(tableView: UITableView, didSelectRowAtIndexPath indexPath: NSIndexPath) {
        print("Entrou aqui!!! Table view go NEXT")
        
        print("Index:\(indexPath.row)")
        tableView.deselectRowAtIndexPath(indexPath, animated: true)
        SystemStatus.sharedInstance.currentGame = SystemStatus.sharedInstance.games[indexPath.row]
        presentViewController(SendBetVC(), animated: true, completion: nil)
    }
    
}

