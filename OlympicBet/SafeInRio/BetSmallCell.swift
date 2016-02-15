//
//  BetSmallCell.swift
//  SafeInRio
//
//  Created by Bruno Baring on 12/Dec/15.
//  Copyright © 2015 Amanda Aurita Araujo Fernandes. All rights reserved.
//

import Foundation
import UIKit

class BetSmallCell: UITableViewCell {

    //Lixo
    var modality = UILabel()
    
    
    //-----Altura da célula (Muda o tamanho da imagem também)------
    let altura : CGFloat = 200.0
    
    //Variables
    var sportLbl: UILabel!
    var team1: UIImageView!
    var team2: UIImageView!
    var xLabel: UILabel!
    var time: UILabel!
    var result: UILabel!
    

    
    
    let margem:CGFloat = SystemStatus.sharedInstance.margem

    override init(style: UITableViewCellStyle, reuseIdentifier: String?) {
        super.init(style: style, reuseIdentifier: reuseIdentifier)
        print(self.frame.height)
        
        let screenSize: CGRect = UIScreen.mainScreen().bounds
        let screenWidth = screenSize.width
        
        //Definindo o tamanho e a cor da célula
        self.frame = CGRectMake(0, 0, screenWidth, altura)
        self.backgroundColor = UIColor.amarelo()
        
        //------Imagens:--------
        team1 = UIImageView(frame: CGRectMake(screenWidth/2, 12, 48, 48))
        self.addSubview(team1)
        
        team2 = UIImageView(frame: CGRectMake(screenWidth/2 + 70, 12, 48, 48))
        self.addSubview(team2)
        
        //--------Labels-----
        sportLbl = UILabel(frame: CGRectMake(0, 10, 200, 40))
        sportLbl.textColor = UIColor.azulClaro()
        sportLbl.textAlignment = NSTextAlignment.Left
        sportLbl.font = UIFont.systemFontOfSize(20)
        self.addSubview(sportLbl)
        
        xLabel = UILabel(frame: CGRectMake(screenWidth/2 + 55, 9, 48, 48))
        xLabel.text = "x"
        self.addSubview(xLabel)
        
        time = UILabel()
        time.frame = CGRectMake(0, 30, 200, 40)
        time.textAlignment = NSTextAlignment.Left
        time.font = UIFont.systemFontOfSize(12)
        time.text = "asd"
        self.addSubview(time)
        
        result = UILabel(frame: CGRectMake(0, 45, 200, 40))
        result.textAlignment = NSTextAlignment.Left
        result.font = UIFont.systemFontOfSize(12)
        self.addSubview(result)
        
       
    }
    
    
    
    func increaseCellSize(){
        //        content.frame.size.height = SystemStatus.sharedInstance.selectedSize - 2 * margem
    }
    
    
    
    
    required init?(coder aDecoder: NSCoder) {
        super.init(coder: aDecoder)
        fatalError("init(coder:) has not been implemented")
    }
}
