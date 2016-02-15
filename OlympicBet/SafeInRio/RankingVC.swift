//
//  RankingVC.swift
//  SafeInRio
//
//  Created by Amanda Aurita Araujo Fernandes on 12/12/15.
//  Copyright © 2015 Amanda Aurita Araujo Fernandes. All rights reserved.
//

import UIKit

class RankingVC: UIViewController, UITableViewDelegate, UITableViewDataSource {
    
    var rankingView : UITableView!

    override func viewDidLoad() {
        super.viewDidLoad()
        
        let bounds = UIScreen.mainScreen().bounds
        let width = bounds.size.width
        let height = bounds.size.height
        
        //-----Configurando a Table-----
        self.rankingView = UITableView(frame: CGRectMake(0, (height)/5, self.view.frame.width, self.view.frame.height))
        self.rankingView.backgroundColor = UIColor.verde()
        self.rankingView.center.x = self.view.center.x
        self.rankingView.delegate = self
        self.rankingView.dataSource = self
        self.rankingView.separatorStyle = .None
        self.rankingView.registerClass(RankingCell.self, forCellReuseIdentifier: "RankingCell")
        self.view.addSubview(self.rankingView)
        
        

        //---------View
        self.view.backgroundColor = UIColor.azulBebe()

    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    //MARK: Funções do delegate e datasource da TableView
    func numberOfSectionsInTableView(tableView: UITableView) -> Int
    {
        return 1
    }
    
    func tableView(tableView: UITableView, numberOfRowsInSection section: Int) -> Int
    {
        //        return SystemStatus.sharedInstance.games.count
        return SystemStatus.sharedInstance.ranking.count
    }
    
    func tableView(tableView: UITableView, heightForRowAtIndexPath indexPath: NSIndexPath) -> CGFloat {
        return 60
    }
    
    func tableView(tableView: UITableView, cellForRowAtIndexPath indexPath: NSIndexPath) -> UITableViewCell
    {
        let cell = tableView.dequeueReusableCellWithIdentifier("RankingCell", forIndexPath: indexPath) as! RankingCell
        
        //--------Texto
        cell.selectionStyle = .None;
        cell.backgroundColor = UIColor.amarelo()
        cell.textLabel?.text = "\((indexPath.row)+1): \(SystemStatus.sharedInstance.ranking[indexPath.row].name!)"
        cell.textLabel?.textAlignment = .Left
        cell.textLabel?.textColor = UIColor.azulEscuro()
        cell.textLabel?.font = UIFont(name: "Avenir-Book", size: 18)
                
        return cell
    }
    
    func tableView(tableView: UITableView, didSelectRowAtIndexPath indexPath: NSIndexPath)
    {
        //        bairroTouched(tableView.cellForRowAtIndexPath(indexPath)!)
    }
}
